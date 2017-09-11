<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<br>
<div class="container">
	<div class="col-md-12 center-block no-float">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo $panel_title ?></h3>
			</div>
			<div class="panel-body">
				<!--<form action="<?php echo base_url(); ?>entrar" method="POST">-->
				<?php if(validation_errors()){ echo '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>'; } ?>
				<?php 
					$hidden = array( 
						'tit_nombres' => $tit_nombres,
			           	'tit_apellidos' => $tit_apellidos,
			           	'tit_cedula' => $tit_cedula,
			           	'tit_rif' => $tit_rif,
			           	'tit_fecha_nac' => $tit_fecha_nac,
			           	'tit_edo_civil' => $tit_edo_civil,
			           	'tit_sexo' => $tit_sexo,
			           	'tit_profesion' => $tit_profesion,
			        	'cot_nombres' => $cot_nombres,
			           	'cot_apellidos' => $cot_apellidos,
			           	'cot_cedula' => $cot_cedula,
			           	'cot_rif' => $cot_rif,
			           	'cot_fecha_nac' => $cot_fecha_nac,
			           	'cot_edo_civil' => $cot_edo_civil,
			           	'cot_sexo' => $cot_sexo,
			           	'calle' => $calle,
			           	'cruce' => $cruce,
			           	'casa' => $casa,
			           	'sector' => $sector,
			           	'piso' => $piso,
			           	'apto' => $apto,
			           	'referencia' => $referencia,
			           	'ciudad' => $ciudad,
			           	'municipio' => $municipio,
			           	'estado' => $estado,
			           	'parroquia' => $parroquia,
			           	'cod_postal' => $cod_postal,
			           	'pais' => $pais,
			           	'tel_local' => $tel_local,
			           	'tel_celular' => $tel_celular,
			           	'email' => $email,
			           	'enrol_codigo' => $enrol_codigo,
			           	'enrol_nombre_completo' => $enrol_nombre_completo,
			           	'patroc_codigo' => $patroc_codigo,
			           	'patroc_nombre_completo' => $patroc_nombre_completo,
			           	'banco_nombre_cta' => $banco_nombre_cta,
			           	'banco_numero_cta' => $banco_numero_cta,
			           	'banco_nombre_bco' => $banco_nombre_bco,
			           	'banco_sucursal' => $banco_sucursal,
			           	'banco_estado' => $banco_estado,
			           	'banco_tipo_cta' => $banco_tipo_cta,
			           	'tipo_persona' => $tipo_persona,
			           	'nacionalidad' => $nacionalidad,
			           	'tipo_afiliado' => $tipo_afiliado,
			           	'tipo_kit' => $tipo_kit,
			           	'fechapago' => $fechapago,
			           	'numcomprobante' => $numcomprobante,
			           	'bancoorigen' => $bancoorigen,
			           	'envio' => $envio,
			           	'direccion_envio' => $direccion_envio
					);
				?>
				<?php echo form_open('contrato','',$hidden); ?>
					<div align="center">
						<br>
						<label for="enrolamiento">TÉRMINOS, PROCEDIMIENTOS Y CONDICIONES DEL CONTRATO DE ALIADO COMERCIAL</label>
						<br>
					</div>
					<div class="row" style="margin-top:1%">
						<div class="col-sm-12" align="justify">
							<input type="checkbox" required><b> 1. Conformidad.</b> A través de la firma y la entrega de este contrato a Corporación Manna de Venezuela, con domicilio en la Ciudad de Valencia, Municipio Valencia, Estado Carabobo, Código postal 2001, el firmante, quien para los efectos de este documento se denominará el “Aliado Comercial Independiente Manna”, acuerda en celebrar un contrato con Corporación Manna de Venezuela, para realizar operaciones como Aliado Comercial Independiente Manna de acuerdo a los términos, procedimientos y condiciones aquí establecidos y a los documentos que se añaden tal cual como lo describe el apartado 3 próximo (en lo adelante “Contrato” o “Contrato de Aliado Comercial Independiente”). Estos documentos son los que constituyen el acuerdo total y absoluto entre el Aliado Comercial Independiente Manna y Corporación Manna de Venezuela una vez aceptado por ambas partes, dicho contrato. Previamente a la designación como Aliado Comercial Independiente Manna, el prospecto deberá adquirir cualquiera de los paquetes de inicio Manna (el “Kit de Inicio Manna”) que contiene productos e información indispensable sobre la oportunidad de negocio Manna (”Oportunidad Manna”). <b>CORPORACIÓN MANNA DE VENEZUELA TENDRÁ EL DERECHO DE ACEPTAR, RECHAZAR O CONDICIONAR SU ACEPTACIÓN AL CONTRATO DE ALIADO COMERCIAL INDEPENDIENTE MANNA, O CUALQUIER RENOVACIÓN DEL MISMO A SU ENTERO JUICIO Y DISCRECIÓN.</b> En el caso de que Corporación Manna de Venezuela rechace este contrato, lo notificará por escrito y reembolsará el costo del Kit de Inicio Manna.<br>
							<br>
						</div>
						<br>
						<div class="col-sm-12" align="justify">
							<input type="checkbox" required><b> 2. Alcance del Contrato.</b> A partir de que Corporación Manna de Venezuela acepte el presente contrato, usted será nombrado Aliado Comercial Independiente Manna en fase de distribución y comercialización. Un Aliado Comercial Independiente Manna en la fase de distribución y comercialización tiene el derecho “no único”, dentro de la línea de patrocinio establecida de Corporación Manna de Venezuela, como se define en los Fundamentos de Comercialización y conforme con los términos, procedimientos y condiciones del presente Contrato, para poder: 2.1. Comprar productos y/o servicios de manera personal, directamente de Corporación Manna de Venezuela para consumo personal o para su venta a clientes a precio de venta al público. El cual podrá ser fijado por Corporación Manna de Venezuela ocasionalmente; 2.2. Realizar pedidos de productos y/o servicios Manna para sus clientes; 2.3. Registrar clientes para que puedan realizar compras demostrables y participen en promociones Manna; 2.4. Atender, Mantener y Conservar a sus propios clientes. 2.5. Recibir información y boletines de la Oportunidad Manna. 2.6. De acuerdo a su desempeño y esfuerzo mensual, hacerse merecedor al pago de bonos calculados de acuerdo al Plan Crecer. 2.7. Recibir descuentos de ventas por Volumen de acuerdo al apartado 4 de este contrato. 2.8. De manera potestativa por parte de Corporación Manna de Venezuela, participar en los programas de premios e incentivos “no monetarios” en la medida que logre las metas y los objetivos establecidos por Corporación Manna de Venezuela eventualmente. Un Aliado Comercial Independiente Manna estará capacitado, sujeto a la terminación de ciertas condiciones en el Plan Crecer (que forma parte del presente contrato y se agregará al mismo por referencia), al desarrollar actividades de Patrocinador bajo los Fundamentos de Comercialización establecidos en la “Fase de Desarrollo de la Oportunidad Manna”.<br>
							Un Aliado Comercial Independiente Manna en la Fase de Desarrollo de la Oportunidad Manna, estará capacitado de manera “no única” dentro de Venezuela y de acuerdo al presente contrato para realizar, en añadidura a las autorizaciones que le apliquen a los Aliados Comerciales Independientes Manna en la fase de distribución y comercialización, lo siguiente: 2.9. Con previa autorización de Corporación Manna de Venezuela,(la cual podrá ser modificada o denegada en cualquier momento) y de acuerdo con los boletines, publicaciones, procedimientos y políticas que estén en vigencia, las cuales estarán a disposición de los Aliados Comerciales Independientes Manna que lo soliciten, patrocinar a nuevos Aliados Comerciales Independientes Manna y/o brindar apoyo a los ya existentes en la línea de auspicio del patrocinador; 2.10. Obtener mensualmente los bonos que se calculen conforme con el Plan Crecer; 2.11. Ser parte de los programas de incentivos “no monetarios” en la medida en que cumpla con las condiciones establecidas como se especifican en el programa de incentivos; y(de) participar en otros programas de oportunidades y crecimiento que comunique Corporación Manna de Venezuela a su entero juicio y total discreción. Corporación Manna de Venezuela se reserva el derecho de tomar medidas de correción en el caso de que los Aliados Comerciales Independientes Manna excedan los alcances de este contrato o cualquier modificación de los mismos.<br>
							<br>
						</div>
						<br>
						<div class="col-sm-12" align="justify">
							<input type="checkbox" required> <b>3. Consentimiento y Aceptación del contrato y documentos añadidos.</b> El Aliado Comercial Independiente Manna expresa de manera clara haber leído y comprendido estos términos, procedimientos y condiciones y acuerda someterse a los mismos. Así mismo, reconoce haber recibido el Kit de Inicio Manna. así como los Fundamentos de Comercialización e información de las Fases de Desarrollo de la Oportunidad Manna (tal y como se establece en el apartado 2 del presente contrato), junto con los Fundamentos de Comercialización para Aliados Comerciales Independientes Manna en fase distribución y comercialización en etapa de Formación de la Oportunidad Manna, el Plan Crecer para Aliados Comerciales Independientes Manna en tales fases (”el Plan Crecer”) y la información oficial de Corporación Manna de Venezuela a lo establecido en el presente documento. Todos los Términos que no se encuentren expresamente definidos en este documento, tendrán el significado que se les asignen en la Guía de Fundamentos Operativos.<br>
							<br>
						</div>
						<br>
						<div class="col-sm-12" align="justify">
							<input type="checkbox" required> <b>4.- Descuentos por Volúmenes.</b> Los Aliados Comerciales Independientes Manna podrán recibir descuentos variables por sus volúmenes de ventas personales, tal y como se especifica en el Plan Crecer. Además a esto, los Aliados Comerciales Independientes Manna, podrán recibir descuentos al inscribirse a la Oportunidad Manna, tal y como lo describe el Plan Crecer.<br>
							<br>
						</div>
						<br>
						<div class="col-sm-12" align="justify">
							<input type="checkbox" required> <b>5.- Retribución Monetaria (Pagos).</b> Los Aliados Comerciales Independientes Manna que se encuentra en cumplimiento de lo establecido en los Fundamentos de Comercialización (los cuales son parte integral de este contrato), podrán recibir el pago de bonos, comisiones y otros premios y reconocimientos de acuerdo al Plan Crecer.<br>
							<br>
						</div>
						<br>
						<div class="col-sm-12" align="justify">
							<input type="checkbox" required> <b>6.- Designación de Clientes Especiales no Inscritos.</b> Corporación Manna de Venezuela, designará de manera aleatoria a los Clientes Preferenciales no Inscritos a los Aliados Comerciales Independientes Manna tomando en cuenta su ubicación y de acuerdo a los estándares anunciados por Corporación Manna de Venezuela en sus publicaciones oficiales. Las compras realizadas por dichos clientes se acreditarán al Aliado Comercial Independiente Manna asignado.<br>
							<br>
						</div>
						<br>
						<div class="col-sm-12" align="justify">
							<input type="checkbox" required> <b>7.- Registro o Inscripción de Clientes Especiales.</b> Sujeto a la autorización, aprobación y consentimiento del cliente, el Aliado Comercial Independiente, está facultado, a su entrera discreción, registrar o inscribir Clientes Especiales con Corporación Manna de Venezuela (”Clientes Especiales”). Corporación Manna de Venezuela será propietario y mantendrá una lista de Clientes Especiales Registrados (”Listas de Clientes Especiales Registrados”) de acuerdo con lo que establece el apartado 8 siguiente. Corporación Manna de Venezuela, podrá, a su entero juicio y total discreción, promocionar directamente con dichos Clientes Especiales Registrados cualquier producto y/o servicio Manna, incluyendo sin limites, programas de lealtad a dichos Clientes Especiales, programas de crédito, promociones de productos y programa de compras frecuentes. Un Clientes Especial Registrado, podrá ordenar productos y/o servicios Manna directamente a través de la página oficial de Corporación Manna de Venezuela y los puntos así como los volúmenes generados por las compras realizadas por los Clientes Especiales Registrados, serán acreditadas al Aliado Comercial Independiente Manna que lo registró o inscribió.<br>
							<br>
						</div>
						<br>
						<div class="col-sm-12" align="justify">
							<input type="checkbox" required> <b>8.- Datos del Aliado Comercial Independiente Manna.</b> A través de la firma de este documento (el “Contrato”) el Aliado Comercial Independiente Manna comprende, entiende, acepta, autoriza y expresa su consentimiento así como su aprobación, a Corporación Manna de Venezuela y/o a cualquiera de sus afiliados, para usar y/o a compartir, y/o a transferir, y/o ceder la información personal contenida en este contrato, así como aquella otra que se genere por motivo de sus actividades (la “información”), toda o parcialmente, a terceras personas, incluyendo a otros Aliados Comerciales Independientes Manna en su línea de Patrocinio, de acuerdo con las leyes aplicables. El Aliado Comercial Independiente Manna acepta, comprende y expresa de manera clara que tiene el derecho y obligación de actualizar sus datos personales cuando sea requerido. El Aliado Comercial Independiente Manna podrá obtener información personal de sus Clientes Especiales Registrados y de otros Aliados Comerciales Independientes Manna. Por otro lado, el Aliado Comercial Independiente Manna está de acuerdo en obtener, resguardar, usar, conservar, mantener, transferir, disponer de y procesar la información personal que reciba directa o indirectamente de los Clientes Especiales Registrados, otros Aliados Comerciales Independientes Manna o cualquier otra persona (independientemente de la forma y/o manera en que la haya obtenido o de la persona que la haya entregado), de manera exclusiva de acuerdo a las instrucciones y Corporación Manna de Venezuela. El Aliado Comercial Independiente Manna: (a) está capacitado para utilizar la información personal para su propia Oportunidad Manna pero no para otros fines; (b) esta sujeto a cumplir con cualquier política de protección y resguardo de información que determine Corporación Manna de Venezuela de tiempo en tiempo y de espacio en espacio; ( c ) se someterá a obligaciones de cuidado y defensa de informaciones similares a las Corporación Manna de Venezuela se encuentra obligada conforme a las leyes aplicables. Se entiende por “Información Personal” a aquella que se refiere a un individuo incluyendo cualquier opinión sobre un individuo y sobre las intenciones de un Aliado Comercial Independiente Manna o cualquier otra persona respecto de dicho individuo que derive de aquella información que tenga o pueda llegar a tener el Aliado Comercial Independiente Manna.<br>
							<br>
						</div>
						<br>
						<div class="col-sm-12" align="justify">
							<input type="checkbox" required> <b>9.- Aliado Comercial Independiente.</b> El Aliado Comercial Independiente Manna comprende, acuerda, establece y lo expresa de manera clara que este Contrato no lo convierte en un empleado, franquisiado, representante o agente de Corporación Manna de Venezuela y no crea ningún tipo de relación laboral o de subordinación entre el Aliado Comercial Independiente Manna y Corporación Manna de Venezuela. El Aliado Comercial Independiente Manna acepta y lo expresa de manera clara que actúa como Contratista respecto de sus actividades y acciones conforme a este Contrato. El Aliado Comercial Independiente Manna reconoce y admite que tiene a su disposición todas las autorizaciones, registros, licencias, que sean necesarias para celebrar este Contrato así como para ejecutar los derechos y cumplir con las obligaciones y deberes establecidos en el mismo y deberá ofrecer y/o proporcionar a Corporación Manna de Venezuela los documentos que lo acrediten, previa solicitud de Corporación Manna de Venezuela. De ninguna manera, y así lo entiende el Aliado Comercial Independiente Manna, deberá interpretarse que el presente Contrato constituye alguna relación laboral, de franquicia, o cualquier otra relación de dependencia o subordinación entre el Aliado Comercial Independiente Manna y Corporación Manna de Venezuela, por lo que el Aliado Comercial Independiente Manna renuncia a cualquier acción o reclamación derivado de lo anterior. El Aliado Comercial Independiente Manna que como Contratista es un auto-empleado y determina en su propio juicio, cuando y el número de horas a trabajar, ser pagadas con bonos basados en la compra y venta de productos y no por el número de horas de trabajo. El Aliado Comercial Independiente Manna está sujeto al riesgo emprendedor y es responsable de todas las pérdidas en que incurra como Aliado Comercial Independiente Manna.. De la misma manera entiende y así lo expresa de manera clara que como Aliado Comercial Independiente Manna paga sus propias cuotas de licencia y cualquier seguro. Es responsable por todos los costos de su Oportunidad Manna, inlcuyendo, pero no de manare limitada, viajes, hospedaje entretenimiento, administrativos, equipos, contables, y gastos en general, sin adelantos, reembolsos o garantía de Corporación Manna de Venezuela. De la misma manera entiende y así lo expresa, que al actuar como Contratista, no es tratado como empleado y por ende, no posee ni tiene derecho alguno a reclamar cualquier tipo de pago o bonificación establecidos en la ley. El Aliado Comercial Independiente Manna reconoce que no hay compras mínimas o inventarios requeridos como persona, así como tampoco existe cuotas de ventas, territorios o clientela asignados y que tiene la total libertad para determinar sus horarios de trabajo y su agenda de actividades. El Aliado Comercial Independiente Manna reconoce que Corporación Manna de Venezuela no le proporcionará ningún espacio y/o lugar físico para el desarrollo de las actividades de Aliado Comercial Independiente de manera permanente.<br>
							<br>
						</div>
						<br>
						<div class="col-sm-12" align="justify">
							<input type="checkbox" required> <b>10.- Vigencia del Contrato.</b> El Contrato de Aliado Comercial Independiente Manna no requiere de ningún tipo de pago por concepto de “Renovación” anual. Dicho contrato podrá ser finalizado en caso de terminación anticipada del mismo por parte del Aliado Comercial Independiente Manna o por parte de Corporación Manna de Venezuela.<br>
							<br>
						</div>
						<br>
						<div class="col-sm-12" align="justify">
							<input type="checkbox" required> <b>11. Modificación de los Términos, Procedimientos y Condiciones.</b> Corporación Manna de Venezuela a su propio juicio y total discreción podrá modificar los términos, procedimientos y condiciones del Contrato de Aliado Comercial Independiente Manna, así como los términos, procedimientos y condiciones de los Documentos añadidos, de manera total o parcial, mediante la notificación de dicha modificación (es) a través de sus publicaciones o en los sitios oficiales de internet de Corporación Manna de Venezuela o de cualquier otra manera que sea permitida conforme a la ley. Todas las modificaciones serán válidas a partir de la fecha que se indiquen la notificación, a menos que Corporación Manna de Venezuela o las leyes locales dispongan de lo contrario. En el caso de que un Aliado Comercial Independiente Manna no esté de acuerdo con alguna de las modificaciones, podrá dar por terminado o finalizado su Contrato de Aliado Comercial Independiente Manna de manera inmediata. Si el Aliado Comercial Independiente Manna no recibe las publicaciones por ninguna de las vías establecidas durante el plazo establecido en el Contrato, podrá obtenerlas directamente de Corporación Manna de Venezuela.<br>
							<br>
						</div>
						<br>
						<div class="col-sm-12" align="justify">
							<input type="checkbox" required> <b>12. Anulación o Terminación del Contrato.</b> El Aliado Comercial Independiente Manna o Corporación Manna de Venezuela podrán dar por terminado el Contrato de Aliado Comercial Independiente Manna: 12.1 En cualquier momento y por cualquier motivo a través de un escrito a la otra parte con Cuarenta y Cinco (45) días de anticipación; o 12.2 mediante una simple notificación o con efectos inmediatos, en caso de incumplimiento de la otra parte de cualquiera de las obligaciones a su cargo del Contrato de Aliado Comercial Independiente Manna. En la medida que lo permita la ley aplicable, Corporación Manna de Venezuela se reserva el derecho a tomar medidas adicionales (de ser necesario) y contempladas en los Fundamentos de Comercialización previamente a la Anulación o Terminación del Contrato de Aliado Comercial Independiente Manna, incluso aquellas que impliquen suspender o revocar ciertos derechos del Aliado Comercial Independiente Manna.<br>
							<br>
						</div>
						<br>
						<div class="col-sm-12" align="justify">
							<input type="checkbox" required> <b>13. Jurisdicción.</b> Este Contrato se regirá e interpretará de acuerdo a las leyes aplicables de Venezuela. Cualquier disposición que se considere inválida o nula, podrá anularse sin que ella implique la nulidad de todo el Contrato y podrá sustituirse por un mandato válido y exigirle que refleje la intención original de las partes. Cualquier discusiòn o debate que derive de la interpretación del contrato, su naturaleza, anulación y/o aplicación del mismo, incluyendo sin limitar las sanciones que pudieran aplicarse de acuerdo a los Fundamentos de Comercialización, será objeto de revisión en la primera instancia por parte de un panel de revisión integrado por el personal ejecutivo apropiado y personal corporativo de la oficina central de Corporación Manna de Venezuela. El panel de revisión se sujetará a los procedimientos establecidos en los Fundamentos de Comerciales, los cuales forman parte del presente Contrato.<br>
							Aquellas disputas que no sean resueltas por el panel de revisión de arbitraje serán sujetas a un tribunal de arbitraje. Tal(es) tribunal (es) estará (n) conformado (s) por uno o tres árbitros, dependiendo de su cuantía. Tal(es) árbitro (s) ser (án) designado (s) de mutuo acuerdo por las partes, o en su defecto por el Centro de Arbitraje y Conciliación Mercantil de la Cámara Venezolana Americana de Industria y Comercio (VENAMCHAN), en Caracas Venezuela. El Tribunal así constituido se someterá a lo dispuesto en los códigos de procedimientos civil y de comercio, de acuerdo con las siguientes reglas: 13.1. La organización interna del tribunal se sujetará a las reglas previstas para el efecto por el centro de arbitraje y conciliación mercantil de la Cámara de Comercio de Valencia, Venezuela. 13.2. El tribunal decidirá el derecho. 13.3. El tribunal tendrá su sede en la Ciudad de Valencia, Venezuela; 13.4. Los honorarios de el (los) arbitro (s) será (n) pagados por la parte vencida; 13.5. Los costos y gastos del proceso arbitral será (n) pagados por la parte perdedora.<br>
							<br>
						</div>
						<br>
						<div class="col-sm-12" align="justify">
							<input type="checkbox" required> <b>14. Límite de Obligaciones.</b> En la medida que la legislación lo permita, la responsabilidad de Corporación Manna de Venezuela derivada de cualquier daño, pérdida, queja, demanda, acción o gasto de cualquier naturaleza derivada del presente Contrato o del incumplimiento de Manna a sus obligaciones, se limitará al pago de una cantidad equivalente al costo del Kit de Inicio Manna. En la medida en que la legislación lo permita, Corporación Manna de Venezuela no será responsable de daños indirectos o consecuencias o pérdidas causadas como resultado de este contrato o de su incumplimiento, incluyendo sin limitar, los daños causados por las pérdidas de ingresos derivados de la Oportunidad Manna. El Aliado Comercial Independiente Manna, está de acuerdo en Indemnizar y sacar en paz y a salvo a Corporación Manna de Venezuela, de cualquier daño o perjuicio, acción, queja, demanda o gasto (incluyendo gastos, costos y honorarios legales) que puedan generarse en relación por las actividades que el Aliado Comercial Independiente Manna haya llevado a cabo con motivo del presente contrato.<br>
							<br>
						</div>
						<br>
						<div class="col-sm-12" align="justify">
							<input type="checkbox" required> <b>15. Convenio Absoluto.</b> El presente Contrato de Aliado Comercial Independiente Manna (incluyendo cualquiera de sus anexos y documentos añadidos) constituye el Convenio Absoluto entre Corporación Manna de Venezuela y el Aliado Comercial Independiente Manna en relación al propósito del presente Contrato, y predomina sobre cualquier otro acuerdo, escrito u oral, entre Corporación Manna de Venezuela y el Aliado Comercial Independiente Manna en relación al mismo propósito.<br>
							<br>
						</div>
						<br>
						<div class="col-sm-12" align="justify">
							<input type="checkbox" required> <b>16. Avisos y Comunicaciones.</b> Cualquier aviso y/o comunicación conforme a este Contrato de Aliado Comercial Independiente Manna deberá hacerse, a disposición de Corporación Manna de Venezuela, por escrito (mediante las publicaciones oficiales de Corporación Manna de Venezuela, incluyendo sin limitación medios impresos y/o revistas y/o la página Internet de Corporación Manna de Venezuela y/o por correo certificado dirigido al domicilio que las partes proporcionen en el adverso de este Contrato) o por correo electrónico, en la medida en que lo permita la legislación aplicable. Cualquier cambio en el domicilio del Aliado Comercial.<br>
							<br>
						</div>
						<br>
					</div>

					<div class="row" style="margin-top:1%" align="right">
						<div class="form_group">
							<div class="col-sm-12 control-label">
								<button type="submit" id="registro" class="btn btn-default">Registro </button>
								<button type="submit" id="salir" class="btn btn-default" onclick="redirect(base_url())">Salir</button>
							</div>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
<!--
					</div>
					<div class="form-group">
-->