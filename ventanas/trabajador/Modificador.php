<?php $stringmodificartrabajador="UPDATE `sicob`.`trabajador` SET `cedula_trab` = \'$_GET[cedula_trab]\', `apellido_trab` = \'$_GET[apellido_trab]\', `nombre_trab` = \'$_GET[nombre_trab]\', `sexo_trab` = \'$_GET[sexo_trab]\', `fecing_trab` = str_to_date('$_GET[fecing_trab]', '%d/%m/%Y'), `cargo_trab` = \'$_GET[cargo_trab]\', `dependencia_trab` = \'S_GET[dependencia_trab]\', `codigo_trab` = \'$_GET[codigo_trab]\', `fecnac_trab` = \'fecnac_trab\' WHERE `trabajador`.`cedula_trab` = '$_GET[cedula_anterior];";?>

<?php UPDATE `sicob`.`trabajador` SET `cedula_trab` = '$_GET=[cedula_trab]',
`apellido_trab` = '$_GET[apellido_trab]',
`nombre_trab` = '$_GET=[nombre_trab]',
`sexo_trab` = '$_GET=[sexo_trab]',
`fecing_trab` = '$_GET=[fecing_trab]',
`cargo_trab` = '$_GET=[cargo_trab]',
`dependencia_trab` = '$_GET=[dependencia_trab]',
`codigo_trab` = '$_GET=[codigo_trab]',
`fecnac_trab` = '$_GET=[fecnac_trab]' WHERE `trabajador`.`cedula_trab` ='$_GET=[cedula_anterior]';?>