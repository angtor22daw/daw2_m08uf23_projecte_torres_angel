<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Attribute;
use Laminas\Ldap\Ldap;

ini_set('display_errors', 0);
#Dades de la nova entrada
#
if ($_POST['uid']&& $_POST['ou'] && $_POST['uidNumber'] && $_POST['gidNumber'] && $_POST['directoriPersonal'] && $_POST['shell'] && $_POST['cn'] && $_POST['sn'] && $_POST['givenName'] && $_POST['mobile'] && $_POST['postalAddress'] && $_POST['telephoneNumber'] && $_POST['title'] && $_POST['description']){
    $uid= $_POST['uid'];
    $ou = $_POST['ou'];
    $uidNumber = $_POST['uidNumber'];
    $gidNumber = $_POST['gidNumber'];
    // $grup=100;
    $homeDirectory = $_POST['directoriPersonal'];
    $loginShell = $_POST['shell'];
    $cn = $_POST['cn'];
    $sn = $_POST['sn'];
    $givenName = $_POST['givenName'];
    $mobile = $_POST['mobile'];
    $postalAddress = $_POST['postalAddress'];
    $telephoneNumber = $_POST['telephoneNumber'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    
    // $dir_pers='/home/usr3';
    // $sh='/bin/bash';
    // $cn="nomis aletse";
    // $sn='nomis';
    // $nom='aletse';
    // $mobil='666778899';
    // $adressa='C/Pi,27,1-1';
    // $telefon='934445566';
    // $titol='analista';
    // $descripcio='analista de sistemes';
    $objcl=array('inetOrgPerson','organizationalPerson','person','posixAccount','shadowAccount','top');
    #
    #Afegint la nova entrada
    $domini = 'dc=fjeclot,dc=net';
    $opcions = [
        'host' => 'zend-antope.fjeclot.net',
        'username' => "cn=admin,$domini",
        'password' => 'fjeclot',
        'bindRequiresDn' => true,
        'accountDomainName' => 'fjeclot.net',
        'baseDn' => 'dc=fjeclot,dc=net',
    ];
    $ldap = new Ldap($opcions);
    $ldap->bind();
    $nova_entrada = [];
    Attribute::setAttribute($nova_entrada, 'objectClass', $objcl);
    Attribute::setAttribute($nova_entrada, 'uid', $uid);
    Attribute::setAttribute($nova_entrada, 'ou', $ou);
    Attribute::setAttribute($nova_entrada, 'uidNumber', $uidNumber);
    Attribute::setAttribute($nova_entrada, 'gidNumber', $gidNumber);
    Attribute::setAttribute($nova_entrada, 'homeDirectory', $homeDirectory);
    Attribute::setAttribute($nova_entrada, 'loginShell', $loginShell);
    Attribute::setAttribute($nova_entrada, 'cn', $cn);
    Attribute::setAttribute($nova_entrada, 'sn', $sn);
    Attribute::setAttribute($nova_entrada, 'givenName', $givenName);
    Attribute::setAttribute($nova_entrada, 'mobile', $mobile);
    Attribute::setAttribute($nova_entrada, 'postalAddress', $postalAddress);
    Attribute::setAttribute($nova_entrada, 'telephoneNumber', $telephoneNumber);
    Attribute::setAttribute($nova_entrada, 'title', $title);
    Attribute::setAttribute($nova_entrada, 'description', $description);
    
    $dn = 'uid='.$uid.',ou='.$ou.',dc=fjeclot,dc=net';
    if($ldap->add($dn, $nova_entrada)) echo "Usuari creat";
}
?>
<html>
<head>
<title>
	CREAR USUARI - PROJECTE LDAP
</title>
</head>
<body>
	<h2>Formulari de creació d'usuari</h2>
	<form action="crearUsuari.php" method="POST">
		UID: <input type="text" name="uid"><br>
		Unitat organitzativa: <input type="text" name="ou"><br>
		UID Number: <input type="text" name="uidNumber"><br>
		GID Number: <input type="text" name="gidNumber"><br>
		Directori Personal: <input type="text" name="directoriPersonal"><br>
		Shell: <input type="text" name="shell"><br>
		cn: <input type="text" name="cn"><br>
		sn: <input type="text" name="sn"><br>
		givenName: <input type="text" name="givenName"><br>
		mobile(número de contacte): <input type="text" name="mobile"><br>
		postalAddress: <input type="text" name="postalAddress"><br>
		telephoneNumber(telefon personal): <input type="text" name="telephoneNumber"><br>
		title: <input type="text" name="title"><br>
		description: <input type="text" name="description"><br>
		<input type="submit"/>
		<input type="reset"/>
	</form>
</body>
</html>

