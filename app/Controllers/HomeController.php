<?php
namespace App\Controllers;
class HomeController
{
   public function index()
   {
       echo "chamou o controller";
   } 

   public function show($id)
   {
       echo $id;
   } 
}