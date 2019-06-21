<?php include("0-config/config-genos.php");

if (isset($_GET["cas"])) {
    $cas = $_GET["cas"];

    switch  ($cas) {
        // GETCLASSE
        case 'getclasse':
        $classe = new classe;
        $req = "select classe.id as id, libelle, numero, classe.suppr, count(eleve.id) as nb_eleve 
        from classe left join eleve on classe.id = eleve.id_classe 
        where classe.suppr = 0 
        group by classe.id 
        order by numero";
        $champs = array("id", "libelle", "numero", "nb_eleve");
        $res = $classe->StructList($req,$champs,"json");
        echo $res;
        break;

        // EDITCLASSE
        case 'editclasse':
        $classe = new classe;
        $item = json_decode(file_get_contents('php://input'), true);
        $classe->id = $_GET['idclasse'];
        $classe->Load();
        $classe->numero = $item['numero'];
        $classe->libelle = $item['libelle'];
        $classe->Update();
        echo $classe->libelle; 
        break;

        // ADDCLASSE
        case 'addclasse':
        $classe = new classe;
        $item = json_decode(file_get_contents('php://input'), true);
        if ($item['numero'] === 0 ) {
            echo -1;
            return;
        }
        $classe->numero = $item['numero'];
        $classe->libelle = $item['libelle'];
        $classe->Add();
        echo $classe->libelle;

        //DELETECLASSE
        case 'deleteclasse':
        $classe = new classe;
        $classe->id = $_GET['idclasse'];
        $classe->Load();
        $classe->Delete();
        echo $classe->libelle;

        //GET ELEVES
        case 'geteleve':
        $eleve = new eleve;
        $req = "SELECT eleve.id, nom, prenom, date_naissance, classe.id as classeId, classe.libelle as classeLibelle, classe.numero as classeNumero 
        FROM `eleve` join classe on eleve.id_classe = classe.id 
        where eleve.suppr = 0";
        $champs = array("id", "nom", "prenom", "date_naissance", "classeId", "classeLibelle", "classeNumero");
        $res = $eleve->StructList($req,$champs,"json");
        echo $res;
        break;

        //ADD ELEVE
        case 'addeleve':
        $eleve = new eleve;
        $item = json_decode(file_get_contents('php://input'), true);
        $eleve->nom = $item['nom'];
        $eleve->prenom = $item['prenom'];
        $eleve->date_naissance = $item['date_naissance'];
        $eleve->id_classe = $item['classe'];
        $eleve->Add();
        echo 'ok';
        break;

        // EDIT ELEVE
        case 'editeleve':
        $eleve = new eleve;
        $item = json_decode(file_get_contents('php://input'), true);
        $eleve->id = $_GET['id'];
        $eleve->Load();
        $eleve->nom = $item['nom'];
        $eleve->prenom = $item['prenom'];
        $eleve->date_naissance = $item['date_naissance'];
        $eleve->id_classe = $item['classe'];
        $eleve->Update();
        echo "ok";
        break;
    }

}

// $cas = $_GET["cas"];

// switch ($cas) {
// 	case 'infosTodosAll':
// 		$t = new todo;
// 		$req = "SELECT * FROM todo ORDER BY nom";
// 		$champs = $t->FieldList();
// 		echo $res = $t->StructList($req,$champs,"json");
// 		break;

// 	case 'addTodo':
// 		$t = new todo;
// 		$t->nom = $_POST["nom"];
// 		$t->Add();
// 		break;

// 	case 'infosTodo':
// 		$id = $_POST["id"];
// 		$t = new todo;
// 		$t->id = $id;
// 		$t->Load();

// 		echo json_encode($t);
// 		break;
	
// 	case 'modifTodo':
// 		$id = $_POST["id"];
// 		$t = new todo;
// 		$t->id = $id;
// 		$t->Load();

// 		$t->nom = $_POST["nom"];
// 		$t->Update();

// 		break;

// 	case 'addTodoLigne':
// 		$tl 			= new todo_ligne;
// 		$tl->id_todo 	= $_POST["id"];
// 		$tl->desig 		= $_POST["tache"];
// 		$tl->Add();
// 		break;

// 	case 'liste':
// 		$id = $_POST["id"];
// 		$tl = new todo_ligne;

// 		$req 	= "SELECT * FROM todo_ligne WHERE id_todo = :id_todo ORDER BY date_crea";
// 		$champs = $tl->FieldList();
// 		$bind 	= array("id_todo"=>$id);
// 		$res 	= $tl->StructList($req,$champs,$bind,"json");
// 		echo $res;
// 		break;

// 	case 'supprTache':
// 		$tl = new todo_ligne;
// 		$tl->id = $_POST["id"];
// 		$tl->Delete();
// 		break;
// 	default:
// 		# code...
// 		break;
// }