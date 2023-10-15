<?php

namespace App\Http\Controllers;

use App\Http\Requests\adicionalRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\respuesta;
use App\Http\Controllers\utils;
use App\Http\Controllers\usuarioController;
use PHPMailer;
use App;
use Models\adetalle;
use Models\tipo_pago;
use Log;

class utilsController extends Controller
{

	public function listarTipoDocumentos()
	{
		return App\tipo_documento::listar();
	}


	public function listarTipoPagos()
	{

		//Cambiar esta variable por el valor del local_id de la app
		// $local_id = 1;
		$data = request()->all();
		$local_id  = $data["idLocal"];

		$tipo_pago = new tipo_pago();
		return $tipo_pago->listarTipoPago($local_id);
	}

	public function terminosCondiciones()
	{
		$documento = '<p style="margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:center;"><strong><span style="font-size:16px;font-family:"Arial",sans-serif;color:#C00000;">T&Eacute;RMINOS, CONDICIONES Y&nbsp;</span></strong><strong><span style="font-size:16px;font-family:"Arial",sans-serif;color:#C00000;">POL&Iacute;TICA DE PROTECCI&Oacute;N DE DATOS PERSONALES</span></strong></p>
		<div style="margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;">
			<ol style="margin-bottom:0cm;list-style-type: decimal;margin-left:4.199999999999999px;">
				<li style="margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;"><strong><span style="font-size:12.0pt;color:black;">T&Eacute;RMINOS Y CONDICIONES</span></strong></li>
			</ol>
			<p>Estos son términos y condiciones de prueba, se puede cambiar por los terminos y condiciones del cliente, recordar que los términos y condiciones deben estar publicados en alguna web pública ya que es requisito fundamental para la publicación de las Apps</p>
		</div>';

		return respuesta::ok([
			"termino" => $documento
		], "ok", true);
	}



	public function testValidation(adicionalRequest $request)
	{

		return respuesta::ok($request->all(), "ok", true);
	}


	/**
	 * Envia un mensaje por correo electronico
	 * @return \App\Http\Controllers\respuesta
	 * @author Juan Ignacio Basilio Flores
	 * @version v1.00.1
	 */
	public function sendMultipleEmail($receptores, $email)
	{
		//return respuesta::ok();
		if ( count( $receptores ) <= 0  || !utils::verificar_elementos(["subject", "content"], $email)) {
			return respuesta::error("No se cuenta con la información necesaria para enviar el correo electrónico solicitado.");
		}

		// $receptor["email"] = strtolower($receptor["email"]);
		$email_user = env('MAIL_USERNAME', "");
		$email_password = env('MAIL_PASSWORD', "");
		$the_subject = $email["subject"];
		$from_name = "Not-reply";
		$phpmailer = new PHPMailer\PHPMailer\PHPMailer();

		// ---------- datos de la cuenta de correo -----------------------------
		$phpmailer->Username = $email_user;
		$phpmailer->Password = $email_password;
		//---------------------------------------------------------------------
		$phpmailer->SMTPSecure = env('MAIL_ENCRYPTION', "");
		$phpmailer->Host = env('MAIL_HOST', "");
		$phpmailer->Port = env('MAIL_PORT', "");

		$phpmailer->IsSMTP();
		$phpmailer->SMTPAuth = true;

		$phpmailer->setFrom($phpmailer->Username, $from_name);

		foreach ($receptores as $key => $value) {
			$phpmailer->AddAddress($value);
		}

		$phpmailer->Subject = $the_subject;

		$phpmailer->Body .= $this->email_htmlBody($email["subject"], $email["content"]);

		$phpmailer->IsHTML(true);
		$phpmailer->CharSet = 'UTF-8';
		if ($phpmailer->Send()) {
			return respuesta::ok("Se ha enviado la petición de inspección.");
		} else {
			return respuesta::error("El correo electrónico no pudo ser enviado. Mailer Error: " . $phpmailer->ErrorInfo, 500);
		}
	}
	public function sendEmail($receptor, $email)
	{
		//return respuesta::ok();
		if (!utils::verificar_elementos(["email"], $receptor) || !utils::verificar_elementos(["subject", "content"], $email)) {
			return respuesta::error("No se cuenta con la información necesaria para enviar el correo electrónico solicitado.");
		}

		$receptor["email"] = strtolower($receptor["email"]);
		$email_user = env('MAIL_USERNAME', "");
		$email_password = env('MAIL_PASSWORD', "");
		$the_subject = $email["subject"];
		$from_name = "Not-reply";
		$phpmailer = new PHPMailer\PHPMailer\PHPMailer();

		// ---------- datos de la cuenta de correo -----------------------------
		$phpmailer->Username = $email_user;
		$phpmailer->Password = $email_password;
		//---------------------------------------------------------------------
		$phpmailer->SMTPSecure = env('MAIL_ENCRYPTION', "");
		$phpmailer->Host = env('MAIL_HOST', "");
		$phpmailer->Port = env('MAIL_PORT', "");

		$phpmailer->IsSMTP();
		$phpmailer->SMTPAuth = true;

		$phpmailer->setFrom($phpmailer->Username, $from_name);
		$phpmailer->AddAddress($receptor["email"]);
		$phpmailer->Subject = $the_subject;

		$phpmailer->Body .= $this->email_htmlBody($email["subject"], $email["content"]);

		$phpmailer->IsHTML(true);
		$phpmailer->CharSet = 'UTF-8';
		if ($phpmailer->Send()) {
			return respuesta::ok("Se ha enviado la petición de inspección.");
		} else {
			return respuesta::error("El correo electrónico no pudo ser enviado. Mailer Error: " . $phpmailer->ErrorInfo, 500);
		}
	}

	public static function email_htmlBody($title, $content)
	{
		$proyecto = env('APP_NAME', "Técnico");
		$body = '
    		<body style="background-color:#F1F1F2">
			    <table style="width: 600px; padding: 40px; margin:0 auto; border-collapse: collapse">
			        <tr>
			            <td style="background-color: #ffffff; text-align: center; padding: 5px ;border-radius: 5px 5px 0 0">
			                <h2>' . $title . '</h2>
			                <hr style="border-style:solid; border-color:#F1F1F2 ; margin:0">
			            </td>
			        </tr>
			        <tr>
			            <td style="background-color: #ffffff ;border-radius: 0 0 5px 5px">
			                <div style="color: #34495e; margin: 4% 5% 2%; text-align: justify;font-family: sans-serif">
			                    <div>
								' . $content . '
			                    </div>
			                </div>
			            </td>
			        </tr>
			        
			        <tr>
			            <td style="background-color: #ffffff ;border-radius: 0 0 5px 5px ">
			                <div style="color: #34495e; margin: 2% 10% 2%; text-align: justify;font-family: sans-serif ">
			                    <p style="color: #b3b3b3; font-size: 12px; text-align: center;margin: 10px 0 0 ">
			                      Equipo ' . $proyecto . '
			                    </p>
			                </div>
			            </td>

			        </tr>
			    </table>
			</body>
    	';
		return $body;
	}

	public function listarTipoDocumentosRegistro()
	{
		return App\tipo_documento::listarAppRegistro();
	}

	public function buscarPersona()
	{
		$token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.MTUwMw.EnfbIUgDODt6NGqnIuJjP9STpL_fOZIhIQBMnXTziuo';
		//Aqui estaba cambiado el 27/10/21 se alterno para no modificar el front
		$numeroDocumento = request('numeroDocumento');
		$tipo = request('tipoDocumento');
		$query = '';

		//Solo momentaneo para que funcione quertium
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );  

		if ($tipo == "1") {
			$reniec = "https://quertium.com/api/v1/reniec/dni/" . $numeroDocumento;
			$query = $reniec;
		} else if ($tipo == "2") {
			$sunat = "https://quertium.com/api/v1/sunat/ruc/" . $numeroDocumento;
			$query = $sunat;
		}
		try {
			Log::info($query . "?token=" . $token);
			$jsonString = file_get_contents($query . "?token=" . $token, false , stream_context_create($arrContextOptions));
			$company = json_decode($jsonString);
			return respuesta::ok($company, "ok", true);
		} catch (\Throwable $th) {
			Log::error($th);
			return respuesta::error("No hubo resultado en la búsqueda", 500, true);
		}
	}
	public function descargarArchivo()
	{
		$id_file = request('id_file');
		$detalle = adetalle::where('adetalle_id', $id_file)->first();
		if ($detalle) {
			return response()->download($detalle->adetalle_url, $detalle->adetalle_nombre, [], 'inline');
		}
	}


	public function descargarArchivoEstatico()
	{
		$nombre_file = request('nombre_file');
		return response()->download('documents/' . $nombre_file, $nombre_file, [], 'inline');
	}
}
