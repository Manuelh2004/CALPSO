<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Block;
use App\Models\Slot;
use App\Models\Sensor;
use App\Models\Sender;
use App\Models\UserBlock;
use App\Models\SensorSender;
use App\Models\SenderBlock;
use DB;

class WF14ES22_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lista = [
            [
                "block_serial" => "WF14-ES22-01",
                "sender_serial" => "jot00036",
                "user_id" => [1,2,4],
                "sensors_data" => [
                    [
                        "sensor_codename" => "PH",
                        "sensor_serial" => "BID01-PH",
                    ],[
                        "sensor_codename" => "TMP",
                        "sensor_serial" => "BID01-TMP",
                    ],[
                        "sensor_codename" => "CR",
                        "sensor_serial" => "BID01-CR",
                    ],[
                        "sensor_codename" => "CA",
                        "sensor_serial" => "BID01-CA",
                    ],[
                        "sensor_codename" => "TRB",
                        "sensor_serial" => "BID01-TRB",
                    ],[
                        "sensor_codename" => "Flujo",
                        "sensor_serial" => "BID01-FLOW",
                    ],[
                        "sensor_codename" => "Vel",
                        "sensor_serial" => "BID01-VEL",
                    ]
                ]
            ],[
                "block_serial" => "WF14-ES22-02",
                "sender_serial" => "jot00031",
                "user_id" => [1,2,4,21],
                "sensors_data" => [
                    [
                        "sensor_codename" => "PH",
                        "sensor_serial" => "BID02-PH",
                    ],[
                        "sensor_codename" => "TMP",
                        "sensor_serial" => "BID02-TMP",
                    ],[
                        "sensor_codename" => "CR",
                        "sensor_serial" => "BID02-CR",
                    ],[
                        "sensor_codename" => "CA",
                        "sensor_serial" => "BID02-CA",
                    ],[
                        "sensor_codename" => "TRB",
                        "sensor_serial" => "BID02-TRB",
                    ],[
                        "sensor_codename" => "Flujo",
                        "sensor_serial" => "BID02-FLOW",
                    ],[
                        "sensor_codename" => "Vel",
                        "sensor_serial" => "BID02-VEL",
                    ]
                ]
            ],[
                "block_serial" => "WF14-ES22-03",
                "sender_serial" => "jot00032",
                "user_id" => [1,2,4,22],
                "sensors_data" => [
                    [
                        "sensor_codename" => "PH",
                        "sensor_serial" => "BID03-PH",
                    ],[
                        "sensor_codename" => "TMP",
                        "sensor_serial" => "BID03-TMP",
                    ],[
                        "sensor_codename" => "CR",
                        "sensor_serial" => "BID03-CR",
                    ],[
                        "sensor_codename" => "CA",
                        "sensor_serial" => "BID03-CA",
                    ],[
                        "sensor_codename" => "TRB",
                        "sensor_serial" => "BID03-TRB",
                    ],[
                        "sensor_codename" => "Flujo",
                        "sensor_serial" => "BID03-FLOW",
                    ],[
                        "sensor_codename" => "Vel",
                        "sensor_serial" => "BID03-VEL",
                    ]
                ]
            ],[
                "block_serial" => "WF14-ES22-04",
                "sender_serial" => "jot00033",
                "user_id" => [1,2,4,23],
                "sensors_data" => [
                    [
                        "sensor_codename" => "PH",
                        "sensor_serial" => "BID04-PH",
                    ],[
                        "sensor_codename" => "TMP",
                        "sensor_serial" => "BID04-TMP",
                    ],[
                        "sensor_codename" => "CR",
                        "sensor_serial" => "BID04-CR",
                    ],[
                        "sensor_codename" => "CA",
                        "sensor_serial" => "BID04-CA",
                    ],[
                        "sensor_codename" => "TRB",
                        "sensor_serial" => "BID04-TRB",
                    ],[
                        "sensor_codename" => "Flujo",
                        "sensor_serial" => "BID04-FLOW",
                    ],[
                        "sensor_codename" => "Vel",
                        "sensor_serial" => "BID04-VEL",
                    ]
                ]
            ],[
                "block_serial" => "WF14-ES22-05",
                "sender_serial" => "jot00034",
                "user_id" => [1,2,4,24],
                "sensors_data" => [
                    [
                        "sensor_codename" => "PH",
                        "sensor_serial" => "BID05-PH",
                    ],[
                        "sensor_codename" => "TMP",
                        "sensor_serial" => "BID05-TMP",
                    ],[
                        "sensor_codename" => "CR",
                        "sensor_serial" => "BID05-CR",
                    ],[
                        "sensor_codename" => "CA",
                        "sensor_serial" => "BID05-CA",
                    ],[
                        "sensor_codename" => "TRB",
                        "sensor_serial" => "BID05-TRB",
                    ],[
                        "sensor_codename" => "Flujo",
                        "sensor_serial" => "BID05-FLOW",
                    ],[
                        "sensor_codename" => "Vel",
                        "sensor_serial" => "BID05-VEL",
                    ]
                ]
            ],[
                "block_serial" => "WF14-ES22-06",
                "sender_serial" => "jot00035",
                "user_id" => [1,2,4,25],
                "sensors_data" => [
                    [
                        "sensor_codename" => "PH",
                        "sensor_serial" => "BID06-PH",
                    ],[
                        "sensor_codename" => "TMP",
                        "sensor_serial" => "BID06-TMP",
                    ],[
                        "sensor_codename" => "CR",
                        "sensor_serial" => "BID06-CR",
                    ],[
                        "sensor_codename" => "CA",
                        "sensor_serial" => "BID06-CA",
                    ],[
                        "sensor_codename" => "TRB",
                        "sensor_serial" => "BID06-TRB",
                    ],[
                        "sensor_codename" => "Flujo",
                        "sensor_serial" => "BID06-FLOW",
                    ],[
                        "sensor_codename" => "Vel",
                        "sensor_serial" => "BID06-VEL",
                    ]
                ]
            ]
        ];

        foreach($lista as $estacion){
            self::creacion_estacion_WF14ES22($estacion);
        }
    }

    static public function creacion_estacion_WF14ES22 ( $lista ) {
        $now = date("Y-m-d h:i:s");

        $block_data = [
            "psis_block_type" => '000001',
            "block_codename" => $lista["block_serial"],
            "block_name" => $lista["block_serial"],
            "block_serial" => $lista["block_serial"],
            "block_latitude" => -11.9273733,
            "block_longitude" => -77.0604119,
            "parent_block_id" => 4,
            "block_status" => 1,
            "created_at" => $now,
            "updated_at" => $now
        ];

        $block = Block::create($block_data);

        $sender_data = [
            "st_id" => 1,
            "sender_serial" => $lista["sender_serial"],
            "sender_status" => 1,
            "sender_max_time_offline" => 60,
            "created_at" => $now,
            "updated_at" => $now
        ];

        $sender = Sender::create($sender_data);

        $user_block_data_tmp = [
            "user_id" => null,
            "block_id" => null,
            "psis_ub_role" => "000009",
            "ub_notification_status" => 0,
            "ub_status" => 1,
            "created_at" => $now,
            "updated_at" => $now
        ];

        foreach($lista["user_id"] as $usuario){
            $user_block_data_tmp["user_id"] = $usuario;
            $user_block_data_tmp["block_id"] = $block->block_id;

            UserBlock::create($user_block_data_tmp);
        }

        $sensor_data_tmp = [
            "sm_id" => null,
            "sensor_codename" => "",
            "sensor_serial" => "",
            "sensor_status" => 1,
            "created_at" => $now,
            "updated_at" => $now
        ];

        $slot_data_tmp = [
            "parameter_id" => null,
            "block_id" => null,
            "sensor_id" => null,
            "up_danger_limit" => null,
            "up_risk_limit" => null,
            "down_risk_limit" => 0,
            "down_danger_limit" => 0,
            "slot_average_limit_state" => 0,
            "slot_status" => 1,
            "slot_visible" => 1,
            "created_at" => $now,
            "updated_at" => $now
        ];

        $sensor_sender_data_tmp = [
            "sensor_id" => null,
            "sender_id" => null,
            "slot_id" => null,
            "ss_channel" => null,
            "ss_status" => 1,
            "created_at" => $now,
            "updated_at" => $now
        ];

        $sender_block_data = [
            "block_id" => null,
            "sender_id" => null,
            "sb_status" => 1,
            "created_at" => $now,
            "updated_at" => $now
        ];

        $formato_sensors_data = [
            "PH" => [
                "sm_id" => 7,
                "sensor_codename" => "PH",
                "parameter_id" => 1,
                "up_danger_limit" => 14,
                "up_risk_limit" => 14,
                "ss_channel" => "MDR8",
                "ss_config" => 'convertDecimalsDTU%MDR8|2'
            ],
            "TMP" => [
                "sm_id" => 8,
                "sensor_codename" => "TMP",
                "parameter_id" => 4,
                "up_danger_limit" => 60,
                "up_risk_limit" => 60,
                "ss_channel" => "MDR9",
                "ss_config" => 'convertDecimalsDTU%MDR9|1'
            ],
            "CR" => [
                "sm_id" => 9,
                "sensor_codename" => "CR",
                "parameter_id" => 7,
                "up_danger_limit" => 2,
                "up_risk_limit" => 2,
                "ss_channel" => "MDR10",
                "ss_config" => "processDTUDataFloat32%MDR10|MDR11"
            ],
            "CA" => [
                "sm_id" => 4,
                "sensor_codename" => "CA",
                "parameter_id" => 14,
                "up_danger_limit" => 10,
                "up_risk_limit" => 10,
                "ss_channel" => "MDR3",
                "ss_config" => 'convertDecimalsDTU%MDR3|3'
            ],
            "TRB" => [
                "sm_id" => 10,
                "sensor_codename" => "TRB",
                "parameter_id" => 6,
                "up_danger_limit" => 5,
                "up_risk_limit" => 5,
                "ss_channel" => "MDR1",
                "ss_config" => "processDTUDataFloat32%MDR1|MDR2"
            ],
            "Flujo" => [
                "sm_id" => 11,
                "sensor_codename" => "Flujo",
                "parameter_id" => 9,
                "up_danger_limit" => 1000,
                "up_risk_limit" => 1000,
                "ss_channel" => "MDR4",
                "ss_config" => "processDTUDataFloat32%MDR4|MDR5"
            ],
            "Vel" => [
                "sm_id" => 12,
                "sensor_codename" => "Vel",
                "parameter_id" => 16,
                "up_danger_limit" => 50,
                "up_risk_limit" => 50,
                "ss_channel" => "MDR6",
                "ss_config" => "processDTUDataFloat32%MDR6|MDR7"
            ]
        ];

        foreach ($lista["sensors_data"] as $sd){
            $data_especifica = $formato_sensors_data[$sd["sensor_codename"]];

            $sensor_data_tmp["sensor_codename"] = $data_especifica["sensor_codename"];
            $sensor_data_tmp["sensor_serial"] = $sd["sensor_serial"];
            $sensor_data_tmp["sm_id"] = $data_especifica["sm_id"];
            $sensor_tmp = Sensor::create($sensor_data_tmp);

            $slot_data_tmp["parameter_id"] = $data_especifica["parameter_id"];
            $slot_data_tmp["block_id"] = $block->block_id;
            $slot_data_tmp["sensor_id"] = $sensor_tmp->sensor_id;
            $slot_data_tmp["up_danger_limit"] = $data_especifica["up_danger_limit"];
            $slot_data_tmp["up_risk_limit"] = $data_especifica["up_risk_limit"];
            $slot_tmp = Slot::create($slot_data_tmp);

            $sensor_sender_data_tmp["sensor_id"] = $sensor_tmp->sensor_id;
            $sensor_sender_data_tmp["sender_id"] = $sender->sender_id;
            $sensor_sender_data_tmp["slot_id"] = $slot_tmp->slot_id;
            $sensor_sender_data_tmp["ss_channel"] = $data_especifica["ss_channel"];
            $sensor_sender_data_tmp["ss_config"] = $data_especifica["ss_config"];
            SensorSender::create($sensor_sender_data_tmp);

            $sender_block_data["block_id"] = $block->block_id;
            $sender_block_data["sender_id"] = $sender->sender_id;
            SenderBlock::create($sender_block_data);

        }

    }
}
