<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\PedidoDetalle;
use App\Models\Usuario;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Js;

class PagoFacilController extends Controller
{
    public function RecolectarDatos(Request $request, Usuario $usuario, Pedido $pedido, $nit)
    {
        try {
            $loRespuestaToken= $this->obtenerToken();
            // iniclizando la variable con el token de acceso 
            $lcTokenAcceso=$loRespuestaToken["values"];
            $detalle = PedidoDetalle::where('pedido_id', $pedido->id)->get();
            $taPedidoDetalle = [];
            foreach ($detalle as $item) {
                $taPedidoDetalle[] = [
                    "tnCantidad" => $item->cantidad,
                    "tcDescripcion" => "Producto",
                    "tnPrecioUnitario" => $item->precio,
                    "tnSubTotal" => $item->precio * $item->cantidad
                ];
            }
            $lcComerceID           = "d029fa3a95e174a19934857f535eb9427d967218a36ea014b70ad704bc6c8d1c";
            $lnMoneda              = 2;
            $lnTelefono            = $usuario->telefono;
            $lcNombreUsuario       = $usuario->nombre;
            $lnCiNit               = $nit;
            $lcNroPago             = "grupo12sc-" . rand(100000, 999999);
            $lnMontoClienteEmpresa = $pedido->monto_total;
            $lcCorreo              = $usuario->correo;
            $lcUrlCallBack         = "https://dcaf6c13-2970-4b12-9a6f-92cc226f358b-00-2mo9qjcuvclsm.kirk.replit.dev/api/urlcallback" . $pedido->id;
            $lcUrlReturn           = "http://localhost:8000/" . $pedido->id;
            $laPedidoDetalle       = Json_encode($taPedidoDetalle);
            $lcUrl                 = "";

            $loClient = new Client();
            if ($request->tnTipoServicio == 1) {
                $lcUrl = "https://serviciostigomoney.pagofacil.com.bo/api/servicio/pagoqr";
            } elseif ($request->tnTipoServicio == 2) {
                $lcUrl = "https://serviciostigomoney.pagofacil.com.bo/api/servicio/pagotigomoney";
            }            

            $laHeader = [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '. $lcTokenAcceso
            ];
            $laBody   = [
                "tcCommerceID"          => $lcComerceID,
                "tnMoneda"              => $lnMoneda,
                "tnTelefono"            => $lnTelefono,
                'tcNombreUsuario'       => $lcNombreUsuario,
                'tnCiNit'               => $lnCiNit,
                'tcNroPago'             => $lcNroPago,
                "tnMontoClienteEmpresa" => $lnMontoClienteEmpresa,
                "tcCorreo"              => $lcCorreo,
                'tcUrlCallBack'         => $lcUrlCallBack,
                "tcUrlReturn"           => $lcUrlReturn,
                'taPedidoDetalle'       => $laPedidoDetalle
            ];
            echo "<pre>";
            echo "url ".$lcUrl ;
            print_r($laBody);

            $loResponse = $loClient->post($lcUrl, [
                'headers' => $laHeader,
                'json' => $laBody
            ]);
            $laResult = json_decode($loResponse->getBody()->getContents());

            if ($request->tnTipoServicio == 1) {

                $laValues = explode(";", $laResult->values)[1];

                $laQrImage = "data:image/png;base64," . json_decode($laValues)->qrImage;
                echo '<img src="' . $laQrImage . '" alt="Imagen base64">';
            } elseif ($request->tnTipoServicio == 2) {

                $csrfToken = csrf_token();

                echo '<h5 class="text-center mb-4">' . $laResult->message . '</h5>';
                echo '<p class="blue-text">Transacción Generada: </p><p id="tnTransaccion" class="blue-text">'. $laResult->values . '</p><br>';
                echo '<iframe name="QrImage" style="width: 100%; height: 300px;"></iframe>';
                echo '<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>';

                echo '<script>
                        $(document).ready(function() {
                            function hacerSolicitudAjax(numero) {
                                // Agrega el token CSRF al objeto de datos
                                var data = { _token: "' . $csrfToken . '", tnTransaccion: numero };
                                
                                $.ajax({
                                    url: \'/consultar\',
                                    type: \'POST\',
                                    data: data,
                                    success: function(response) {
                                        var iframe = document.getElementsByName(\'QrImage\')[0];
                                        iframe.contentDocument.open();
                                        iframe.contentDocument.write(response.message);
                                        iframe.contentDocument.close();
                                    },
                                    error: function(error) {
                                        console.error(error);
                                    }
                                });
                            }

                            setInterval(function() {
                                hacerSolicitudAjax(' . $laResult->values . ');
                            }, 7000);
                        });
                    </script>';


            
            }
            /*$laValues = explode(";", $laResult->values)[1];
            $base64_string = json_decode($laValues)->qrImage;
            $image = base64_decode($base64_string);
            return response($image, 200, ['Content-Type' => 'image/png']);*/
        } catch (\Throwable $th) {
            return $th->getMessage() . " - " . $th->getLine();
        }
    }
    public function GenerarQR(Request $request, Pedido $pedido)
    {
        try {
            $loRespuestaToken= $this->obtenerToken();          

            // iniclizando la variable con el token de acceso 
            $lcTokenAcceso=$loRespuestaToken["values"];
            $usuario = auth()->user();
            $nit = $usuario->id + 10000;
            $detalle = PedidoDetalle::where('pedido_id', $pedido->id)->get();
            $taPedidoDetalle = [];
            foreach ($detalle as $item) {
                $taPedidoDetalle[] = [
                    "tnCantidad" => $item->cantidad,
                    "tcDescripcion" => "Producto",
                    "tnPrecioUnitario" => $item->precio,
                    "tnSubTotal" => $item->precio * $item->cantidad
                ];
            }
            //$url = env("APP_ENV") ?? 'https://tecnoweb.org.bo/inf513/grupo12sc/laura/public';
            $lcComerceID           = "d029fa3a95e174a19934857f535eb9427d967218a36ea014b70ad704bc6c8d1c";
            $lnMoneda              = 2;
            $lnTelefono            = $usuario->telefono ?? 65947484;
            $lcNombreUsuario       = $usuario->name;
            $lnCiNit               = $nit;
            $lcNroPago             = "grupo12sc-" . rand(100000, 999999);
            $lnMontoClienteEmpresa = $pedido->monto_total;
            $lcCorreo              = $usuario->email;
            $lcUrlCallBack         = "https://dcaf6c13-2970-4b12-9a6f-92cc226f358b-00-2mo9qjcuvclsm.kirk.replit.dev/api/urlcallback" . $pedido->id;
            $lcUrlReturn           = "http://localhost:8000/" . $pedido->id;
            $laPedidoDetalle       = Json_encode($taPedidoDetalle);
            $lcUrl                 = "";

            $loClient = new Client();
            if ($request->tnTipoServicio == 1) {
                $lcUrl = "https://serviciostigomoney.pagofacil.com.bo/api/servicio/pagoqr";
            } elseif ($request->tnTipoServicio == 2) {
                $lcUrl = "https://serviciostigomoney.pagofacil.com.bo/api/servicio/pagotigomoney";
            }

            $laHeader = [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '. $lcTokenAcceso
            ];
            $laBody   = [
                "tcCommerceID"          => $lcComerceID,
                "tnMoneda"              => $lnMoneda,
                "tnTelefono"            => $lnTelefono,
                'tcNombreUsuario'       => $lcNombreUsuario,
                'tnCiNit'               => $lnCiNit,
                'tcNroPago'             => $lcNroPago,
                "tnMontoClienteEmpresa" => $lnMontoClienteEmpresa,
                "tcCorreo"              => $lcCorreo,
                'tcUrlCallBack'         => $lcUrlCallBack,
                "tcUrlReturn"           => $lcUrlReturn,
                'taPedidoDetalle'       => $laPedidoDetalle
            ];
            $loResponse = $loClient->post($lcUrl, [
                'headers' => $laHeader,
                'json' => $laBody
            ]);
            $laResult = json_decode($loResponse->getBody()->getContents());
            if ($request->tnTipoServicio == 1) {

                $laValues = explode(";", $laResult->values)[1];

                $laQrImage = "data:image/png;base64," . json_decode($laValues)->qrImage;
                echo '<img src="' . $laQrImage . '" alt="Imagen base64">';
            } elseif ($request->tnTipoServicio == 2) {

                $csrfToken = csrf_token();

                echo '<h5 class="text-center mb-4">' . $laResult->message . '</h5>';
                echo '<p class="blue-text">Transacción Generada: </p><p id="tnTransaccion" class="blue-text">'. $laResult->values . '</p><br>';
                echo '<iframe name="QrImage" style="width: 100%; height: 300px;"></iframe>';
                echo '<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>';

                echo '<script>
                        $(document).ready(function() {
                            function hacerSolicitudAjax(numero) {
                                // Agrega el token CSRF al objeto de datos
                                var data = { _token: "' . $csrfToken . '", tnTransaccion: numero };
                                
                                $.ajax({
                                    url: \'/consultar\',
                                    type: \'POST\',
                                    data: data,
                                    success: function(response) {
                                        var iframe = document.getElementsByName(\'QrImage\')[0];
                                        iframe.contentDocument.open();
                                        iframe.contentDocument.write(response.message);
                                        iframe.contentDocument.close();
                                    },
                                    error: function(error) {
                                        console.error(error);
                                    }
                                });
                            }

                            setInterval(function() {
                                hacerSolicitudAjax(' . $laResult->values . ');
                            }, 7000);
                        });
                    </script>';


            
            }
            $laValues = explode(";", $laResult->values)[1];
            $base64_string = json_decode($laValues)->qrImage;
            $image = base64_decode($base64_string);
            return response($image, 200, ['Content-Type' => 'image/png']);
        } catch (\Throwable $th) {
            return $th->getMessage() . " - " . $th->getLine();
        }
    }
    public function ConsultarEstado(Request $request)
    {
        $lnTransaccion = $request->tnTransaccion;

        $loClientEstado = new Client();

        $lcUrlEstadoTransaccion = "https://serviciostigomoney.pagofacil.com.bo/api/servicio/consultartransaccion";

        $laHeaderEstadoTransaccion = [
            'Accept' => 'application/json'
        ];

        $laBodyEstadoTransaccion = [
            "TransaccionDePago" => $lnTransaccion
        ];

        $loEstadoTransaccion = $loClientEstado->post($lcUrlEstadoTransaccion, [
            'headers' => $laHeaderEstadoTransaccion,
            'json' => $laBodyEstadoTransaccion
        ]);

        $laResultEstadoTransaccion = json_decode($loEstadoTransaccion->getBody()->getContents());
        return response()->json(['message' => $laResultEstadoTransaccion]);
       

       $texto = '<h5 class="text-center mb-4">Estado Transacción: ' . $laResultEstadoTransaccion->values->messageEstado . '</h5><br>';

       return response()->json(['message' => $texto]);
    }

    public function urlCallback(Request $request, Pedido $pedido)
    {
        $pedido->estado =  $request->input("Estado");
        $pedido->save();
        try {
            $arreglo = ['error' => 0, 'status' => 1, 'message' => "Pago realizado correctamente.", 'values' => true];
        } catch (\Throwable $th) {
            $arreglo = ['error' => 1, 'status' => 1, 'messageSistema' => "[TRY/CATCH] " . $th->getMessage(), 'message' => "No se pudo realizar el pago, por favor intente de nuevo.", 'values' => false];
        }
        return response()->json($arreglo);
    }

    public function obtenerToken()
    {
        // Crear una instancia del cliente HTTP
        $loClient = new Client();

        // URL del servicio de login
        $lcUrl = "https://serviciostigomoney.pagofacil.com.bo/api/servicio/login";
/*
        [2:24 p.m., 18/11/2024] +591 62037370: CommerceID: d029fa3a95e174a19934857f535eb9427d967218a36ea014b70ad704bc6c8d1c
        [2:25 p.m., 18/11/2024] +591 62037370: TokenSecret: 9E7BC239DDC04F83B49FFDA5
        [2:25 p.m., 18/11/2024] +591 62037370: TokenService: 51247fae280c20410824977b0781453df59fad5b23bf2a0d14e884482f91e09078dbe5966e0b970ba696ec4caf9aa5661802935f86717c481f1670e63f35d5041c31d7cc6124be82afedc4fe926b806755efe678917468e31593a5f427c79cdf016b686fca0cb58eb145cf524f62088b57c6987b3bb3f30c2082b640d7c52907
*/            
        // Definir los encabezados de la solicitud
        $laHeader = [
            'Accept' => 'application/json',
        ];
        // Definir el cuerpo de la solicitud con los datos necesarios
        $laBody = [
            'TokenService' => '51247fae280c20410824977b0781453df59fad5b23bf2a0d14e884482f91e09078dbe5966e0b970ba696ec4caf9aa5661802935f86717c481f1670e63f35d5041c31d7cc6124be82afedc4fe926b806755efe678917468e31593a5f427c79cdf016b686fca0cb58eb145cf524f62088b57c6987b3bb3f30c2082b640d7c52907', // Debes reemplazar con la llave correspondiente
            'TokenSecret' => '9E7BC239DDC04F83B49FFDA5',    // Debes reemplazar con la llave correspondiente
        ];
        try {
            // Realizar la solicitud POST
            $loResponse = $loClient->post($lcUrl, [
                'headers' => $laHeader,
                'json' => $laBody,
            ]);
            // Obtener y decodificar la respuesta
            $laResult = json_decode($loResponse->getBody()->getContents(), true);
            return $laResult ;
          
        } catch (\Exception $e) {
            // Manejar errores de la solicitud HTTP
            return [
                'error' => true,
                'message' => 'Error al realizar la solicitud: ' . $e->getMessage(),
            ];
        }
    }
}
