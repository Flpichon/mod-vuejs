<?php include("0-config/config-genos.php");

$cas = $_GET["cas"];

switch  ($cas) {
    case 'toto':
    $classe = new classe;
    $classe->libelle = "toto";
    $classe->numero = 1;
    $classe->Add();
    break;
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