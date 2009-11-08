<?php
/*
 * @version $Id$
 -------------------------------------------------------------------------
 GLPI - Gestionnaire Libre de Parc Informatique
 Copyright (C) 2003-2009 by the INDEPNET Development Team.

 http://indepnet.net/   http://glpi-project.org
 -------------------------------------------------------------------------

 LICENSE

 This file is part of GLPI.

 GLPI is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 GLPI is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with GLPI; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 --------------------------------------------------------------------------
 */

// ----------------------------------------------------------------------
// Original Author of file: Julien Dombre
// Purpose of file:
// ----------------------------------------------------------------------

$NEEDED_ITEMS=array("cartridge","computer","consumable","contact","contract","document","enterprise",
                    "knowbase","monitor","networking","peripheral","phone","printer","software",
                    "tracking");

define('GLPI_ROOT', '..');
include (GLPI_ROOT . "/inc/includes.php");
header("Content-Type: text/html; charset=UTF-8");
header_nocache();

if (!isset($_POST["id"])) {
   exit();
}

$doc= new Document();

if ($_POST["id"]>0 && $doc->can($_POST["id"],'r')) {
   switch ($_REQUEST['glpi_tab']) {
      case -1 :
         $doc->showItems();
         Document::showAssociated($doc);
         displayPluginAction(DOCUMENT_TYPE,$_POST["id"],$_REQUEST['glpi_tab']);
         break;

      case 5 :
         Document::showAssociated($doc);
         break;

      case 10 :
         showNotesForm( $_POST['target'],DOCUMENT_TYPE,$_POST["id"]);
         break;

      default :
         if (!displayPluginAction(DOCUMENT_TYPE,$_POST["id"],$_REQUEST['glpi_tab'])) {
            $doc->showItems();
         }
         break;
   }
}
ajaxFooter();

?>