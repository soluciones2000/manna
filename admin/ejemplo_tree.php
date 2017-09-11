<html>
<head>
    <style type="text/css">
        body {
            font-family: Trebuchet MS,Helvetica,Verdana,Arial,sans-serif;;
            font-size: 10pt;
        }    
        .treeMenuDefault {
            font-style: italic;
        }
    </style>
    <script src="TreeMenu.js" language="JavaScript" type="text/javascript"></script>
</head>
<body>


<script type="text/javascript">
//<![CDATA[
	objTreeMenu_1 = new TreeMenu("imagesAlt2", "objTreeMenu_1", "_self", "treeMenuDefault", true, false);
	 newNode = objTreeMenu_1.addItem(new TreeNode('Directorio', 'folder.gif', 'http://www.desarrolloweb.com/directorio', false, true, '', '', 'folder-expanded.gif'));
	 newNode_1 = newNode.addItem(new TreeNode('Programación', 'folder.gif', 'http://www.desarrolloweb.com/directorio/programacion', false, true, '', '', 'folder-expanded.gif'));
	 newNode_1.setEvent('ontoggle', 'alert("Has cambiado la rama Programación");');
	 newNode_1_1 = newNode_1.addItem(new TreeNode('HTML', 'folder.gif', 'http://www.desarrolloweb.com/directorio/programacion/html/', false, true, '', '', 'folder-expanded.gif'));
	 newNode_1_2 = newNode_1.addItem(new TreeNode('javascript', 'folder.gif', 'http://www.desarrolloweb.com/directorio/programacion/javascript/', false, true, '', '', 'folder-expanded.gif'));
	 newNode_1_3 = newNode_1.addItem(new TreeNode('PHP', 'folder.gif', 'http://www.desarrolloweb.com/directorio/programacion/php/', false, true, '', '', 'folder-expanded.gif'));
	 newNode_1_3.setEvent('onexpand', 'alert("Has expandido la rama PHP");');
	 newNode_1_3.setEvent('oncollapse', 'alert("Has cerrado la rama PHP");');
	 newNode_1_3_1 = newNode_1_3.addItem(new TreeNode('Scripts PHP', 'folder.gif', 'http://www.desarrolloweb.com/directorio/programacion/php/scripts_en_php/', false, true, '', '', 'folder-expanded.gif'));
	 newNode_1_3_2 = newNode_1_3.addItem(new TreeNode('Manuales PHP', 'folder.gif', 'http://www.desarrolloweb.com/directorio/programacion/php/manuales_de_php/', false, true, '', '', 'folder-expanded.gif'));
	 newNode_2 = newNode.addItem(new TreeNode('Sistemas', 'folder.gif', 'http://www.desarrolloweb.com/directorio/sistemas', false, true, '', '', 'folder-expanded.gif'));
	 newNode_3 = newNode.addItem(new TreeNode('Bases de datos', 'folder.gif', 'http://www.desarrolloweb.com/directorio/bases_de_datos/', false, true, '', '', 'folder-expanded.gif'));

	objTreeMenu_1.drawMenu();
	objTreeMenu_1.writeOutput();
	objTreeMenu_1.resetBranches();
// ]]>
</script><br /><br />

</body>
</html>
