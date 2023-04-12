<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Attribute;
use Laminas\Ldap\Ldap;

ini_set('display_errors', 0);
#
# Entrada a esborrar: usuari 3 creat amb el projecte zendldap2
#
if ($_POST['uid']&& $_POST['ou']){
    $uid= $_POST['uid'];
    $ou = $_POST['ou'];
    // $uid = 'usr3';
    // $ou = 'usuaris';
    $dn = 'uid='.$uid.',ou='.$ou.',dc=fjeclot,dc=net';
    #
    #Opcions de la connexió al servidor i base de dades LDAP
    $opcions = [
        'host' => 'zend-antope.fjeclot.net',
        'username' => 'cn=admin,dc=fjeclot,dc=net',
        'password' => 'fjeclot',
        'bindRequiresDn' => true,
        'accountDomainName' => 'fjeclot.net',
        'baseDn' => 'dc=fjeclot,dc=net',
    ];
    #
    # Esborrant l'entrada
    #
    $ldap = new Ldap($opcions);
    $ldap->bind();
    try{
        $ldap->delete($dn);
        echo "<b>Entrada esborrada</b><br>";
    } catch (Exception $e){
        echo "<b>Aquesta entrada no existeix</b><br>";
    }
}
?>
<html>
<head>
<title>
	ELIMINAR USUARI - PROJECTE LDAP
</title>
</head>
<body>
	<h2>Formulari de eliminació d'usuari</h2>
	<form action="eliminarUsuari.php" method="POST">
		UID: <input type="text" name="uid"><br>
		Unitat organitzativa: <input type="text" name="ou"><br>
		<input type="submit" value ="Eliminar usuari"/>
		<input type="reset"/><br><br>
		<a href="http://zend-antope.fjeclot.net/autent/menu.php">Tornar a al menú</a>
	</form>
</body>
</html>

