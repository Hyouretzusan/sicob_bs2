<?php 
    include("bdd/funciones_mysql.php");
    conectar();
    extract ($_GET);

    if(isset($_GET['enviar_modfam']))
    {
        $cedulavieja                = $_GET['cedula_anterior'];
        $stringmodificarfamfact     = "UPDATE factura_trab SET cedula_fact = '$_GET[cedula_fam]' WHERE cedula_fact = '$cedulavieja'";
        $sqlmodificarfamfact        = mysql_query($stringmodificarfamfact) or die ("ERROR: Linea 10".mysql_error());
        $stringmodificarfamiliar    = "UPDATE familiar SET cedula_fam = '$_GET[cedula_fam]', apellido_fam = '$_GET[apellido_fam]', nombre_fam = '$_GET[nombre_fam]', sexo_fam = '$_GET[sexo_fam]', parentesco_fam = '$_GET[parentesco_fam]', patologia_fam = '$_GET[patologia_fam]', discapacidad_fam = '$_GET[discapacidad_fam]', codigo_fam = '$_GET[codigo_fam]', fecnac_fam = '$_GET[fecnac_fam]' WHERE cedula_fam = '$cedulavieja'";
        $sqlmodificarfamiliar       = mysql_query($stringmodificarfamiliar) or die ("ERROR: Linea 12".mysql_error());
        ?>
        <script> alert("Familiar Modificado Exitosamente"); </script>
        <?php
    }

    $stringConsulta = "SELECT * FROM familiar WHERE cedula_fam = '".$_GET['cedula']."'";
    $sqlConsulta    = mysql_query($stringConsulta) or die ("Error: ".mysql_error());
    $campoConsulta  = mysql_fetch_array($sqlConsulta);
?>

<style>
    #cuadro 
    {
        border-bottom:2px; 
        border-bottom-color:#880000;
        border-left:2px; border-left-color:#880000; 
        border-right:2px; 
        border-right-color:#880000; 
        border-top:2px; 
        border-top-color:#880000;
        border-radius:10px;
        background-color:#FFF;
    }
    #cuerpomodificarfamiliar
    {
        width:auto
    }
</style>
<center>
    <form name="inserta" id="inserta" method="get" onSubmit = "return verifica(this)">
        <input name="sec" type="hidden" value="ventanas/familiares/modificar_familiar" />
        <input name="cedula" type="hidden" value="<?php echo $campoConsulta['cedula_fam']?>" />
        <fieldset id="cuerpomodificarfamiliar" style="background-color:#FFF">
            <legend style="font-size:16pt; font:Georgia, 'Times New Roman', Times, serif ; color:#880000" align="center">
                <strong>MODIFICAR FAMILIAR</strong>
            </legend>
            <table width="50%" border="0" id="cuadro">
                <tr>
                    <td width="31%"><strong>Cedula Anterior</strong></td>
                    <td width="69%">
                        <input name="cedula_anterior" type="text" id="cedula_anterior" style="width:98%;height:100%;background:#FF9" value="<?php echo $campoConsulta['cedula_fam']?>" size="20" readonly="readonly" />
                    </td>
                </tr>
                <tr>
                    <td width="31%"><strong>Cedula Nueva</strong></td>
                    <td width="69%">
                        <input name="cedula_fam" maxlength="21" type="text" id="cedula_fam" value="<?php echo $campoConsulta['cedula_fam']?>" style="width:98%;height:100%" size="20" required="required"  />
                    </td>
                </tr>
                <tr>
                    <td><strong>Apellido</strong></td>
                    <td>
                        <input name="apellido_fam" type="text" maxlength="40" id="apellido_fam" value="<?php echo $campoConsulta['apellido_fam']?>" style="width:98%" size="20" required="required" />
                    </td>
                </tr>
                <tr>
                    <td><strong>Nombre</strong></td>
                    <td>
                        <input type="text" maxlength="40" name="nombre_fam" id="nombre_fam" value="<?php echo $campoConsulta['nombre_fam']?>" style="width:98%" required="required" />
                    </td>
                </tr>
                <tr>
                    <td><strong>Sexo</strong></td>
                    <td>
                        <select name="sexo_fam" id="sexo_fam" style="width:99%">
                            <option value="0" <?php if($campoConsulta['sexo_fam'] == '0') echo 'selected' ?>>Seleccione Sexo</option>
                            <option value="Femenino" <?php if($campoConsulta['sexo_fam'] == 'Femenino') echo 'selected' ?>>Femenino</option>
                            <option value="Masculino" <?php if($campoConsulta['sexo_fam'] == 'Masculino') echo 'selected' ?>>Masculino</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><strong>Parentesco</strong></td>
                    <td>
                        <select name="parentesco_fam" id="parentesco_fam" style="width:99%">
                            <option value="0" <?php if($campoConsulta['parentesco_fam'] == '0') echo 'selected' ?>>Seleccione Parentesco</option>
                            <option value="Madre" <?php if($campoConsulta['parentesco_fam'] == 'Madre') echo 'selected' ?>>Madre</option>
                            <option value="Padre" <?php if($campoConsulta['parentesco_fam'] == 'Padre') echo 'selected' ?>>Padre</option>
                            <option value="Esposo/a" <?php if($campoConsulta['parentesco_fam'] == 'Esposo/a') echo 'selected' ?>>Esposo/a</option>
                            <option value="Hijo/a" <?php if($campoConsulta['parentesco_fam'] == 'Hijo/a') echo 'selected' ?>>Hijo/a</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><strong>Patologia</strong></td>
                    <td>
                        <select name="patologia_fam" id="patologia_fam" style="width:99%">
                            <option value="No" <?php if($campoConsulta['patologia_fam'] == 'No') echo 'selected' ?>>No</option>
                            <option value="Si" <?php if($campoConsulta['patologia_fam'] == 'Si') echo 'selected' ?>>Si</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><strong>Discapacidad</strong></td>
                    <td>
                        <select name="discapacidad_fam" id="discapacidad_fam" style="width:99%">
                            <option value="No" <?php if($campoConsulta['discapacidad_fam'] == 'No') echo 'selected' ?>>No</option>
                            <option value="Si" <?php if($campoConsulta['discapacidad_fam'] == 'Si') echo 'selected' ?>>Si</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><strong>Codigo</strong></td>
                    <td>
                        <input type="text" maxlength="50" name="codigo_fam" id="codigo_fam" value="<?php echo $campoConsulta['codigo_fam']?>" style="width:98%" required="required"  />
                    </td>
                </tr>
                <tr>
                    <td><strong>Fecha de Nacimiento</strong></td>
                    <td>
                        <input name="fecnac_fam" type ="date" id="fecnac_trab" value="<?php echo $campoConsulta['fecnac_fam']?>" style="width:98%" required="required" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center" valign="middle">
                        <input type="submit" name="enviar_modfam" id="enviar_modfam" value="Enviar" />
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
</center>