<?
	class Ep  extends Controller {		
		function __construct ( $params ) {
			parent::__construct();			
			global $_CFG;
			//
			// print_r ( $_GET );
			// exit;
			
			$this -> view -> controller = "Ep";
			$action = "EpList"; // < ------------------------------------------
			
			require_once 'models/ep.model.php';
			// $this -> model = new EpModel();
			
			$this -> view -> page = "Form.Ep";
			$this -> view -> controller = "Ep";			
			
			$action = "EpShowForm";
			if ( isset ($_GET['mode']) && $_GET['mode'] != '' ){
				$mode = $_GET['mode'];
				$action = $mode;
			}
			//
			if ($_SERVER['REQUEST_METHOD']=="POST") {
				
				
			}
			//			
			try {
				$this -> $action ( $params );
			}catch ( Exception $e2 ) {
				echo 'nie ma takiej metody #204 <br />';
				echo $e2 -> getMessage() . '\n';
			}
		}
		private function EpSearch(){
			global $_CFG;
			$this -> view -> page = "List.Ep";
			// echo '<p>hello in ep search </p>';
			/*
			connect to three database; 
			It could be three different source
			*/
			// print_r ( $_POST );
			// exit;
			$loginToSearch = '';
			$emailToSearch = '';
			if ( isset ( $_POST['loginName'] )&& $_POST['loginName'] != ''  ){
				$loginToSearch = pg_escape_string ( $_POST['loginName'] );
			} 
			if ( isset ( $_POST['emailName'] ) && $_POST['emailName'] != '' ) {
				$emailToSearch = pg_escape_string ( $_POST['emailName'] );
			}
			$tables = array ( 'ep_user_a', 'ep_user_b', 'ep_user_c' );
			$count = 0;
			$lengthOfTable = array ();
			$this->view->dataSearch = array ();
			foreach ( $tables as $tableName ) {
				$this->view->base[$count] = new EpModel( $_CFG['database']['host'], $_CFG['database']['dbName'], $_CFG['database']['user'], $_CFG['database']['pass'], $tableName );
				$this->view->base[$count]->setTableName( $tableName );
				$this->view->dataAll[$count] = $this->view->base[$count]->getDataAll ();
				$this->view->dataSearch[$count] = $this->view->base[$count]->getDataSearch ( $loginToSearch, $emailToSearch );
				$this->view->loginToSearch = $loginToSearch;
				$this->view->emailToSearch = $emailToSearch;
				$this->view->lengthOfTable[$count] = $this->view->base[$count]->getRowNumber();
				$count++;
			}
			//
			 $this->view->sortNumbersOfRows = $this->view->base[0]->array_sort($this->view->lengthOfTable, '', SORT_DESC );
			
			// echo '<pre>';
			// print_r ($this->view->dataSearch );
			// exit;
			
			
			$this -> view -> RenderHeader();
			$this -> view -> RenderMenuLogin();
			$this -> view -> RenderContent();
			$this -> view -> RenderFooter();
		}
		//
		private function EpSearchFirst(){
			global $_CFG;
			$this -> view -> page = "List.Ep";
			// echo '<p>hello in ep search </p>';
			/*
			connect to three database; 
			It could be three different source
			*/
			// print_r ( $_POST );
			// exit;
			$loginToSearch = '';
			$emailToSearch = '';
			if ( isset ( $_POST['loginName'] )&& $_POST['loginName'] != ''  ){
				$loginToSearch = pg_escape_string ( $_POST['loginName'] );
			} 
			if ( isset ( $_POST['emailName'] ) && $_POST['emailName'] != '' ) {
				$emailToSearch = pg_escape_string ( $_POST['emailName'] );
			}
			$tables = array ( 'ep_user_a', 'ep_user_b', 'ep_user_c' );
			$count = 0;
			$lengthOfTable = array ();
			$this->view->dataSearch = array ();
			foreach ( $tables as $tableName ) {
				$this->view->base[$count] = new EpModel( $_CFG['database']['host'], $_CFG['database']['dbName'], $_CFG['database']['user'], $_CFG['database']['pass'], $tableName );
				$this->view->base[$count]->setTableName( $tableName );
				$this->view->dataAll[$count] = $this->view->base[$count]->getDataAll ();
				$this->view->dataSearch[$count] = $this->view->base[$count]->getDataSearch ( $loginToSearch, $emailToSearch );
				// print_r ($this->view->dataAll );
				// exit;
				$this->view->loginToSearch = $loginToSearch;
				$this->view->emailToSearch = $emailToSearch;
				$lengthOfTable[$count] = $this->view->base[$count]->getRowNumber();
				$count++;
			}
			//
			$this->view->sortNumbersOfRows = $this->view->base[0]->array_sort($lengthOfTable, '', SORT_DESC );
			
			
			
			$this -> view -> RenderHeader();
			$this -> view -> RenderMenuLogin();
			$this -> view -> RenderContent();
			$this -> view -> RenderFooter();
		}
		private function EpShowForm() {
			/*
			Mamy 3 bazy danych z użytkownikami (id, login, e-mail, hasło). Użytkownicy mają różne adresy mailowe lub loginy 
			w różnych bazach, np. jankowalski@op.pl ma w jednej bazie login janek, a w drugiej jkowal. Należy przygotować
			stronę w PHP (OOP), która pozwoli na wprowadzenie loginu i e-maila, a następnie na podstawie tych danych 
			pokaże listę baz, w których te dane się nie zgadzają. Musi być też możliwość pobrania pliku z wynikiem w formie csv. 
			*/
			
			$this -> view -> RenderHeader();
			$this -> view -> RenderMenuLogin();
			$this -> view -> RenderContent();
			$this -> view -> RenderFooter();
		}
	}
?>