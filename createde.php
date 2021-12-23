<?php require('exacttarget_soap_client.php');="" require('s1_creds.php');="" $wsdl='https://$_REQUEST['subdomain'].soap.marketingcloudapis.com/etframework.wsdl' ;="" try{="" $client="new" exacttargetsoapclient($wsdl,="" array('trace'=""?>1));
    
    
    $client->username = $_REQUEST['cliendID'];
    $client->password = $_REQUEST['clientsecret'];

    $newde = new Marketing Cloud_DataExtension();
    $newde->Name = "New DETEST";
    $newde->CustomerKey = "New DETEST";
    $newde->IsSendable = true;
    $newde->IsTestable = false;

    $newde->SendableDataExtensionField = new Marketing Cloud_DataExtensionField();
    $newde->SendableDataExtensionField->Name = 'EMAIL';
    $newde->SendableSubscriberField = new Marketing Cloud_Attribute();
    $newde->SendableSubscriberField->Name = 'Email Address';
    $newde->Fields = array();
    $emailfield = new Marketing Cloud_DataExtensionField();
    $emailfield->Name = 'EMAIL';
    $emailfield->IsPrimaryKey = true;
    $emailfield->IsRequired = true;
    $emailfield->FieldType = Marketing Cloud_DataExtensionFieldType::EmailAddress;
    $newde->Fields[] = $emailfield;
    $fnamefield = new Marketing Cloud_DataExtensionField();
    $fnamefield->Name = 'First Name';
    $fnamefield->IsPrimaryKey = false;
    $fnamefield->FieldType = Marketing Cloud_DataExtensionFieldType::Text;
    $newde->Fields[] = $fnamefield;
    $lnamefield = new Marketing Cloud_DataExtensionField();
    $lnamefield->Name = 'Last Name';
    $lnamefield->IsPrimaryKey = false;
    $lnamefield->FieldType = Marketing Cloud_DataExtensionFieldType::Text;
    $newde->Fields[] = $lnamefield;
    $object = new SoapVar($newde, SOAP_ENC_OBJECT, 'DataExtension', "http://exacttarget.com/wsdl/partnerAPI");
    $request = new Marketing Cloud_CreateRequest();
    $request->Options = NULL;
    $request->Objects = array($object);
    $results = $client->Create($request);
    var_dump($results);

} catch (Exception  $e) {
    var_dump($e);
}
?>