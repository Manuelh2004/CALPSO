<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\WebhookService;
use App\Models\WebhookReport;


class WebhookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date("Y-m-d h:i:s");
        WebhookService::truncate();
        WebhookReport::truncate();

        DB::table('webhook_service')->insert(
            [
                // 'ws_id' => 1,
                'ws_url' => "https://prerural.vivienda.gob.pe:8082/api/TRS_TELEMETRIA/measure",
                'ws_auth_parameters' => json_encode([
                    "username"=> "measure_user",
                    "password"=> "9*reE0OxM4JS"
                ]),
                'ws_auth_url' => 'https://prerural.vivienda.gob.pe:8082/api/login/authenticate',
                'ws_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('webhook_report')->insert([
            [
                // 'wr_id' => 1,
                'ws_id' => 1,
                'sender_id' => 19, // Zona more
                'wr_period_report' => 60,
                'wr_function_report' => 'wf14_es22_datass',
                'wr_config_parameters' => json_encode([
                        "idProveedor"=> 2,
                        "idCentroPoblado"=> 91749,
                        "idSAP"=> 163800,
                        "idDevice"=> 6,
                        "detalle"=> [
                            [
                                "idTipoMedida"=> 4,
                                "channel"=> "MDR10" // Cloro residual
                            ],
                            [
                                "idTipoMedida"=> 2,
                                "channel"=> "MDR1" // Turbiedad
                            ],
                            [
                                "idTipoMedida"=> 1,
                                "channel"=> "MDR4" // Caudal
                            ],
                            [
                                "idTipoMedida"=> 3,
                                "channel"=> "MDR8" // PH
                            ],
                            [
                                "idTipoMedida"=> 5,
                                "channel"=> "MDR9" // Temperatura
                            ]
                        ]
                    ]),
                'wr_next_report' => $now,
                'wr_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                // 'wr_id' => 1,
                'ws_id' => 1,
                'sender_id' => 20, // Playas norte
                'wr_period_report' => 60,
                'wr_function_report' => 'wf14_es22_datass',
                'wr_config_parameters' => json_encode([
                        "idProveedor"=> 2,
                        "idCentroPoblado"=> 77068,
                        "idSAP"=> 150726,
                        "idDevice"=> 7,
                        "detalle"=> [
                            [
                                "idTipoMedida"=> 4,
                                "channel"=> "MDR10" // Cloro residual
                            ],
                            [
                                "idTipoMedida"=> 2,
                                "channel"=> "MDR1" // Turbiedad
                            ],
                            [
                                "idTipoMedida"=> 1,
                                "channel"=> "MDR4" // Caudal
                            ],
                            [
                                "idTipoMedida"=> 3,
                                "channel"=> "MDR8" // PH
                            ],
                            [
                                "idTipoMedida"=> 5,
                                "channel"=> "MDR9" // Temperatura
                            ]
                        ]
                    ]),
                'wr_next_report' => $now,
                'wr_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],[
                // 'wr_id' => 1,
                'ws_id' => 1,
                'sender_id' => 21, //Nueva Arenita
                'wr_period_report' => 60,
                'wr_function_report' => 'wf14_es22_datass',
                'wr_config_parameters' => json_encode([
                        "idProveedor"=> 2,
                        "idCentroPoblado"=> 8895,
                        "idSAP"=> 15050,
                        "idDevice"=> 8,
                        "detalle"=> [
                            [
                                "idTipoMedida"=> 4,
                                "channel"=> "MDR10" // Cloro residual
                            ],
                            [
                                "idTipoMedida"=> 2,
                                "channel"=> "MDR1" // Turbiedad
                            ],
                            [
                                "idTipoMedida"=> 1,
                                "channel"=> "MDR4" // Caudal
                            ],
                            [
                                "idTipoMedida"=> 3,
                                "channel"=> "MDR8" // PH
                            ],
                            [
                                "idTipoMedida"=> 5,
                                "channel"=> "MDR9" // Temperatura
                            ]
                        ]
                    ]),
                'wr_next_report' => $now,
                'wr_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],[
                // 'wr_id' => 1,
                'ws_id' => 1,
                'sender_id' => 22, // San Antonio
                'wr_period_report' => 60,
                'wr_function_report' => 'wf14_es22_datass',
                'wr_config_parameters' => json_encode([
                        "idProveedor"=> 2,
                        "idCentroPoblado"=> 130803,
                        "idSAP"=> 375838,
                        "idDevice"=> 9,
                        "detalle"=> [
                            [
                                "idTipoMedida"=> 4,
                                "channel"=> "MDR10" // Cloro residual
                            ],
                            [
                                "idTipoMedida"=> 2,
                                "channel"=> "MDR1" // Turbiedad
                            ],
                            [
                                "idTipoMedida"=> 1,
                                "channel"=> "MDR4" // Caudal
                            ],
                            [
                                "idTipoMedida"=> 3,
                                "channel"=> "MDR8" // PH
                            ],
                            [
                                "idTipoMedida"=> 5,
                                "channel"=> "MDR9" // Temperatura
                            ]
                        ]
                    ]),
                'wr_next_report' => $now,
                'wr_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],[
                // 'wr_id' => 1,
                'ws_id' => 1,
                'sender_id' => 23, // Costarica
                'wr_period_report' => 60,
                'wr_function_report' => 'wf14_es22_datass',
                'wr_config_parameters' => json_encode([
                        "idProveedor"=> 2,
                        "idCentroPoblado"=> 7713,
                        "idSAP"=> 13014,
                        "idDevice"=> 10,
                        "detalle"=> [
                            [
                                "idTipoMedida"=> 4,
                                "channel"=> "MDR10" // Cloro residual
                            ],
                            [
                                "idTipoMedida"=> 2,
                                "channel"=> "MDR1" // Turbiedad
                            ],
                            [
                                "idTipoMedida"=> 1,
                                "channel"=> "MDR4" // Caudal
                            ],
                            [
                                "idTipoMedida"=> 3,
                                "channel"=> "MDR8" // PH
                            ],
                            [
                                "idTipoMedida"=> 5,
                                "channel"=> "MDR9" // Temperatura
                            ]
                        ]
                    ]),
                'wr_next_report' => $now,
                'wr_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);


    }
}
