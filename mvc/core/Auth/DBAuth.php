<?php 

// REMPLACERA LE AUTH A LA RACINE
// 
// 
// 
// namespace Core\Auth;

// use Core\Database\Database;
// use Core\Str;

// class DBAuth {
    
//     private $db;

//     public function __construct(Database $db) {
	
//     	$this->db = $db;

//     }

//     public function login ($db, $username, $password, $remember = false){

//         $user = $this->user_exist($db, $username, $password);
//         if ($user){

//             if (password_verify($password, $user->password)) {

//                 // On stock l'utilisateur dans la variable session
//                 $this->connect($user);

//                 //Verification si la case "se rappeler" de moi est cochée
//                 if ($remember) {

//                     // voir plus securise
//                     $remember_token = Str::random(250);
                    
//                     // $req = $pdo->prepare('SELECT * FROM users WHERE remeber_token != NULL');
//                     $db->query('UPDATE users SET remember_token = ? WHERE id = ?', [$remember_token, $user->id]);

//                     // cookie qui tiendra 7 jours
//                     setcookie('remember', $user->id . '==' . $remember_token . sha1($user->id . 'BookCase'), time() + 60 * 60 * 24 * 7);


//                 }

//                 return $user;

//             }else {

//                return false;

//             }

//         }
//         else {
//             return false;
//         }

//     }

// }

?>