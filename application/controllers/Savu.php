<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Savu extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
		
	 // Constructeur du contrôleur, il charge les différents modèles
	 
	public function __construct()
	{
		parent::__construct();

	}
	 
	 // Fonction qui charge la vue correspondant à la page d'accueil
	 
	public function index()
	{
		if ($this->session->userdata('type') == 'admin'){
			
			$data['menu']  = 'menu_admin.php';
			
			$data['moyenne'] =  $this->enregistrementconversation_model->get_moyenne_tempscomm()[0]['tempsappel'];
			if($data['moyenne'] == null){
				$data['moyenne'] = 0;
			}
			$data['nb_resolus'] = $this->ticket_model->nb_tickets_resolus();
			$data['nb_tickets'] = $this->ticket_model->nb_tickets();
			$this->load->vars($data);
			$this->load->view('accueil_administrateur');
			
		} elseif($this->session->userdata('type') == 'technicien'){
			$moyenne_amabilite = 0;
			$moyenne_rapidite = 0;
			$moyenne_didactique = 0;
			
			
			
			$id = $this->session->userdata('id');
			$nb_tickets = $this->technicien_model->nb_tickets($id);
	
			$tickets = $this->ticket_model->get_id_ticket_technicien($id);
			
			$notes = array();
			
			foreach($tickets as $key => $unTicket){
					$notes = $this->satisfaction_model->get_notes($unTicket['idticket']);
			}
			
			$compteur = 0;
			$somme_amabilite = 0;
			$somme_rapidite = 0;
			$somme_didactique = 0;
			
			if($notes != array()){
				foreach($notes as $key => $uneNote){
					$somme_amabilite = $somme_amabilite + $uneNote['noteamabilite'];
					$somme_rapidite = $somme_rapidite + $uneNote['noterapidite'];
					$somme_didactique = $somme_didactique + $uneNote['notedidactique'];
					$compteur++;
				}
				$moyenne_amabilite = $somme_amabilite / $compteur;
				$moyenne_rapidite = $somme_rapidite/ $compteur;
				$moyenne_didactique = $somme_didactique / $compteur;
			}
			
			$data['moyenne_amabilite'] = $moyenne_amabilite; 
			$data['moyenne_rapidite'] = $moyenne_rapidite;
			$data['moyenne_didactique'] = $moyenne_didactique;
			
 			$data['statut'] = $this->technicien_model->get_statut($this->session->userdata('id'))[0]['statut'];
			$data['menu'] = 'menu_technicien.php';
			$data['nb_tickets'] = $nb_tickets;
			
			$this->technicien_model->temps_communication_zero($this->session->userdata('id'));
			$this->load->vars($data);
			$this->load->view('accueil_technicien');

		} else {
			
			$data['menu'] = 'menu.php';
			
			$this->load->vars($data);
			$this->load->view('accueil');
		}
	}

	// Fonction qui change le statut du technicien
	
	public function changer_statut(){
		$id = $this->session->userdata('id');
		$statut = $this->technicien_model->get_statut($id)[0]['statut'];
		if($statut == "disponible"){
			$this->technicien_model->statut_indisponible($id);
			$this->technicien_model->temps_communication_zero($id);
		} else {
			$this->technicien_model->statut_disponible($id);
			$this->technicien_model->temps_communication_zero($id);
		}
		redirect('savu/index', 'refresh');
	}
	
	// Fonction appelée toutes les 15 secondes grâce au Javascript afin de rafraichir le temps de communication du technicien lorsque il est en appel
	
	public function update_tempscommunication($idtechnicien){
		$this->technicien_model->temps_communication_update($idtechnicien);
	}
	
	 // Fonction qui charge la vue correspondant à la page de connexion
	 
	public function connexion()
	{
		if ($this->session->userdata('type') == 'admin'){
			$data['menu']  = 'menu_admin.php';
		} elseif($this->session->userdata('type') == 'technicien'){
			$data['menu'] = 'menu_technicien.php';
		} else {
			$data['menu'] = 'menu.php';
		}
		
		$rules = [
						[ 'field'  => 'login',
						  'label'  => 'Login',
						  'rules'  => 'callback_logincheck',
						  'errors' => []
						],
						[ 'field'  => 'password',
						  'label'  => 'Password',
						  'rules'  => 'callback_passwordcheck',
						  'errors' => []
						]
					];
					
			$this->form_validation->set_rules($rules);
			
			if($this->form_validation->run()==FALSE){
				$this->load->vars($data);
				$this->load->view('connexion');
			}else{
	    		$id = $this->utilisateur_model->get_idutilisateur($this->input->post('login'))[0]['iduser'];
	    		$type = $this->utilisateur_model->get_type($id)[0]['type'];
	    		
	    		if($type == "technicien"){
	    			$this->technicien_model->statut_disponible($id);
	    			$this->technicien_model->temps_communication_zero($id);
	    		}
	    		$this->session->set_userdata('id', $id);
		    	$this->session->set_userdata('type', $type);
		    	$this->session->set_userdata('login', $this->input->post('login'));
		        $this->session->set_userdata('password', $this->input->post('password'));
		        
		        redirect('savu/index', 'refresh');
			}
	}
	
	
	public function logincheck($login)
    {
        $data = FALSE;
    	if($login == NULL){
    		$this->form_validation->set_message('logincheck', "Vous devez saisir un login.");
    	} else if($this->utilisateur_model->login_in($login)){
        	$data = TRUE;
    	} else {
    		$this->form_validation->set_message('logincheck', "Le login est incorrect.");
    	}
        return $data;
    }
	
	public function passwordcheck($password)
    {
    	$data = FALSE;
    	if($password == NULL){
    		$this->form_validation->set_message('passwordcheck', "Vous devez saisir un mot de passe.");
    	} else if($this->utilisateur_model->password_for_login($this->input->post('login')) != array()){
    		if($this->utilisateur_model->password_for_login($this->input->post('login'))[0]['password'] == $password){
    			$data = TRUE;
    		} else {
    			$this->form_validation->set_message('passwordcheck', "Le mot de passe est incorrect.");	
    		}
    	} else {
    		$this->form_validation->set_message('passwordcheck', "");	
    	}
        return $data;
    }
	
	// Fonction qui permet la déconnexion
	
	public function deconnexion()
	{
		$id = $this->session->userdata('id');
		$type = $this->session->userdata('type');
	    		
		if($type == "technicien"){
			$this->technicien_model->statut_offline($id);
			$this->technicien_model->temps_communication_zero($id);
		}
	    	
		$array_items = array('login', 'password', 'type', 'id');
		$this->session->unset_userdata($array_items);
		$this->session->sess_destroy();
		redirect('savu/index', 'refresh');
		
	}
	
	// Fonction qui charge la vue correspondant à la page de gestion des tickets
	
	public function gestion_ticket($idticket){
		
		if($this->session->userdata('type') == 'admin'){
			$data['menu']  = 'menu_admin.php';
		} elseif($this->session->userdata('type') == 'technicien'){
			$data['menu'] = 'menu_technicien.php';
		} else {
			$data['menu'] = 'menu.php';
		}
		
			$rules = [
						[ 'field'  => 'statut',
						  'label'  => 'statut',
						  'rules'  => 'required',
						  'errors' => ''
						],
						[ 'field'  => 'type',
						  'label'  => 'type',
						  'rules'  => '',
						  'errors' => ''
						],
						[ 'field'  => 'produit',
						  'label'  => 'produit',
						  'rules'  => '',
						  'errors' => ''
						],
						[ 'field'  => 'email',
						  'label'  => 'email',
						  'rules'  => '',
						  'errors' => ''
						],
						[ 'field'  => 'prenom',
						  'label'  => 'prenom',
						  'rules'  => '',
						  'errors' => ''
						],
						[ 'field'  => 'nom',
						  'label'  => 'nom',
						  'rules'  => '',
						  'errors' => ''
						],
						[ 'field'  => 'probleme',
						  'label'  => 'probleme',
						  'rules'  => '',
						  'errors' => ''
						]
					];
					
		$this->form_validation->set_rules($rules);
		
        if($this->form_validation->run()==FALSE)
		{
			$data['content'] = 'form';
			$data['idticket'] = $idticket;
			$data['monticket']= $this->ticket_model->get_ticket($idticket);
			$data['liste_tickets']= $this->ticket_model->get_liste_ticket_client($data['monticket'][0]['client']);
			$data['client'] = $this->client_model->get_client($data['monticket'][0]['client']);
			
			$this->load->vars($data);
			$this->load->view('gestion_ticket');
			
		}else
        {
        	$idtechnicien = $this->session->userdata('id'); 
        	$ticket = $this->ticket_model->get_ticket($idticket);
        	
        	$type = $this->input->post('type');
        	$produit = $this->input->post('produit');
        	$email = $this->input->post('email');
        	$prenom = $this->input->post('prenom');
        	$nom = $this->input->post('nom');
			$probleme = $this->input->post('probleme');
			$statut = $this->input->post('statut');
			
			$nomproduit = $this->produit_model->get_nomproduit($produit)[0]['nomproduit'];
			$nomtechnicien = $this->utilisateur_model->get_nomtechnicien($idtechnicien)[0]['nom'];
			$prenomtechnicien = $this->utilisateur_model->get_prenomtechnicien($idtechnicien)[0]['prenom'];
			
			$this->technicien_model->temps_communication_zero($this->session->userdata('id'));
			$this->technicien_model->statut_indisponible($idtechnicien);	
			
			$this->mail_model->envoi_mail($idticket, $email, $prenom, $nom, $nomproduit, $produit, $statut, $idtechnicien, $nomtechnicien, $prenomtechnicien, $probleme);
			
			$this->ticket_model->set_id_technicien($idticket, $idtechnicien);
			$this->ticket_model->modif_ticket($idticket,$probleme,$statut,$type,$produit);
			
			$this->client_model->set_client($ticket[0]['client'],$email,$prenom,$nom);
			
			$this->index();
		}
	}
	
	// Fonction qui charge la vue correspondant à la page du détail d'un ticket 
	
	public function detail_ticket($idticket){
		
		if($this->session->userdata('type') == 'admin'){
			$data['menu']  = 'menu_admin.php';
		} elseif($this->session->userdata('type') == 'technicien'){
			$data['menu'] = 'menu_technicien.php';
		} else {
			$data['menu'] = 'menu.php';
		}
		
		$data['ticket'] = $this->ticket_model->get_ticket($idticket);
		$data['client'] = $this->client_model->get_client($data['ticket'][0]['client']);
		
		$this->load->vars($data);
		$this->load->view('detail_ticket');
		
		
	}
	
	// Fonction qui charge la vue correspondant à la page de gestion des techniciens
	
	public function gestion_techniciens(){
		
		if($this->session->userdata('type') == 'admin'){
			$data['menu']  = 'menu_admin.php';
		} elseif($this->session->userdata('type') == 'technicien'){
			$data['menu'] = 'menu_technicien.php';
		} else {
			$data['menu'] = 'menu.php';
		}
		
		$data['techniciens'] = $this->utilisateur_model->get_liste_techniciens();
		
		$this->load->vars($data);
		$this->load->view('gestion_techniciens');
	}
	
	public function charger_dernier_ticket(){
		
		$idticket = $this->ticket_model->get_id_ticket_recent();
		
		redirect("savu/gestion_ticket/$idticket", "refresh");
	}
	
	// Fonction qui charge la vue correspondant à la liste des clients
	
	public function clients(){
		
		if($this->session->userdata('type') == 'admin'){
			$data['menu']  = 'menu_admin.php';
		} elseif($this->session->userdata('type') == 'technicien'){
			$id = $this->session->userdata('id');
			$this->technicien_model->temps_communication_zero($id);
			$data['menu'] = 'menu_technicien.php';
		} else {
			$data['menu'] = 'menu.php';
		}
		
		$data['clients'] = $this->client_model->get_liste_clients();
		
		$this->load->vars($data);
		$this->load->view('clients');
	}
	
	// Fonction qui permet à un administrateur de supprimer un technicien dans la BDD
	
	public function supprimer_technicien($idtechnicien)
	{
		$data = $this->ticket_model->get_ticket_by_technicien($idtechnicien);
		if(empty($data)){
			$this->technicien_model->supprimer_technicien($idtechnicien);
			$this->utilisateur_model->supprimer_utilisateur($idtechnicien);
			redirect("savu/gestion_techniciens", "refresh");
		}else{
			echo "<font color=black size=5><center>Le technicien gère encore au moins un ticket, vous ne pouvez pas le supprimer.<br />Vous allez être redirigé vers la liste des techniciens.</center></font>";
			$this->output->set_header('refresh:5;url='+$config['base_url']);
		}
	}
	
	// Fonction qui permet à un administrateur d'ajouter un technicien dans la BDD
	
	public function ajouter_technicien()
	{
		// À faire : vérifier que le technicien n'est pas déjà dans la BDD
		
		if($this->session->userdata('type') == 'admin'){
			$data['menu']  = 'menu_admin.php';
		} elseif($this->session->userdata('type') == 'technicien'){
			$data['menu'] = 'menu_technicien.php';
		} else {
			$data['menu'] = 'menu.php';
		}
		
		$rules = [
						[ 'field'  => 'nom',
						  'label'  => 'Nom',
						  'rules'  => 'required',
						  'errors' => [
						  				'required' => 'Vous devez rentrer un nom.'
						  				]
						],
						[ 'field'  => 'prenom',
						  'label'  => 'Prenom',
						  'rules'  => 'required',
						  'errors' => [
						  				'required' => 'Vous devez rentrer un prénom.'
 						  				]
						],
						[ 'field'  => 'login',
						  'label'  => 'Login',
						  'rules'  => 'required',
						  'errors' => [
						  				'required' => 'Vous devez rentrer un login.'
						  				]
						],
						[ 'field'  => 'password',
						  'label'  => 'Password',
						  'rules'  => 'required',
						  'errors' => [
						  				'required' => "Vous devez rentrer un mot de passe."
						  				]
						]
					];
					
			$this->form_validation->set_rules($rules);
			
			if($this->form_validation->run()==FALSE){
				$this->load->vars($data);
				$this->load->view('ajouter_technicien');
			}else{
				
				$type = "technicien";
				
				$this->utilisateur_model->ajouter_utilisateur($_POST['login'], $_POST['password'], $_POST['nom'], $_POST['prenom'], $type);
				
				$iduser = $this->utilisateur_model->get_max_id_technicien()[0]['iduser'];
				
				$this->technicien_model->ajouter_technicien($iduser);
				
		        redirect('savu/gestion_techniciens', 'refresh');
			}
	}
}
