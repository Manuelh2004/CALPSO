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

class WF13ES22_Seeder extends Seeder
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
                "block_serial" => "WF13-ES22-01",
                "sender_serial" => "jot00014",
                "user_id" => [1,2,3,5],
                "sensors_data" => [
                    [
                        "sensor_codename" => "PH",
                        "sensor_serial" => "22110774-PH",
                    ],[
                        "sensor_codename" => "TMP",
                        "sensor_serial" => "22110774-TMP",
                    ],[
                        "sensor_codename" => "CR",
                        "sensor_serial" => "22110662",
                    ],[
                        "sensor_codename" => "CA",
                        "sensor_serial" => "PZEM14-001",
                    ],[
                        "sensor_codename" => "CD",
                        "sensor_serial" => "KEHAO-001",
                    ],[
                        "sensor_codename" => "Flujo",
                        "sensor_serial" => "HUAIBEI-001",
                    ]
                ]
            ],[
                "block_serial" => "WF13-ES22-02",
                "sender_serial" => "jot00015",
                "user_id" => [1,2,3,6],
                "sensors_data" => [
                    [
                        "sensor_codename" => "PH",
                        "sensor_serial" => "22110769-PH",
                    ],[
                        "sensor_codename" => "TMP",
                        "sensor_serial" => "22110769-TMP",
                    ],[
                        "sensor_codename" => "CR",
                        "sensor_serial" => "22110131",
                    ],[
                        "sensor_codename" => "CA",
                        "sensor_serial" => "PZEM14-002",
                    ],[
                        "sensor_codename" => "CD",
                        "sensor_serial" => "KEHAO-002",
                    ],[
                        "sensor_codename" => "Flujo",
                        "sensor_serial" => "HUAIBEI-002",
                    ]
                ]
            ],[
                "block_serial" => "WF13-ES22-03",
                "sender_serial" => "jot00016",
                "user_id" => [1,2,3,7],
                "sensors_data" => [
                    [
                        "sensor_codename" => "PH",
                        "sensor_serial" => "22110775-PH",
                    ],[
                        "sensor_codename" => "TMP",
                        "sensor_serial" => "22110775-TMP",
                    ],[
                        "sensor_codename" => "CR",
                        "sensor_serial" => "22110130",
                    ],[
                        "sensor_codename" => "CA",
                        "sensor_serial" => "PZEM14-003",
                    ],[
                        "sensor_codename" => "CD",
                        "sensor_serial" => "KEHAO-003",
                    ],[
                        "sensor_codename" => "Flujo",
                        "sensor_serial" => "HUAIBEI-003",
                    ]
                ]
            ],[
                "block_serial" => "WF13-ES22-04",
                "sender_serial" => "jot00017",
                "user_id" => [1,2,3,8],
                "sensors_data" => [
                    [
                        "sensor_codename" => "PH",
                        "sensor_serial" => "22110765-PH",
                    ],[
                        "sensor_codename" => "TMP",
                        "sensor_serial" => "22110765-TMP",
                    ],[
                        "sensor_codename" => "CR",
                        "sensor_serial" => "22110137",
                    ],[
                        "sensor_codename" => "CA",
                        "sensor_serial" => "PZEM14-004",
                    ],[
                        "sensor_codename" => "CD",
                        "sensor_serial" => "KEHAO-004",
                    ],[
                        "sensor_codename" => "Flujo",
                        "sensor_serial" => "HUAIBEI-004",
                    ]
                ]
            ],[
                "block_serial" => "WF13-ES22-05",
                "sender_serial" => "jot00018",
                "user_id" => [1,2,3,9],
                "sensors_data" => [
                    [
                        "sensor_codename" => "PH",
                        "sensor_serial" => "22110767-PH",
                    ],[
                        "sensor_codename" => "TMP",
                        "sensor_serial" => "22110767-TMP",
                    ],[
                        "sensor_codename" => "CR",
                        "sensor_serial" => "22110129",
                    ],[
                        "sensor_codename" => "CA",
                        "sensor_serial" => "PZEM14-005",
                    ],[
                        "sensor_codename" => "CD",
                        "sensor_serial" => "KEHAO-005",
                    ],[
                        "sensor_codename" => "Flujo",
                        "sensor_serial" => "HUAIBEI-005",
                    ]
                ]
            ],[
                "block_serial" => "WF13-ES22-06",
                "sender_serial" => "jot00019",
                "user_id" => [1,2,3,10],
                "sensors_data" => [
                    [
                        "sensor_codename" => "PH",
                        "sensor_serial" => "22110761-PH",
                    ],[
                        "sensor_codename" => "TMP",
                        "sensor_serial" => "22110761-TMP",
                    ],[
                        "sensor_codename" => "CR",
                        "sensor_serial" => "22110132",
                    ],[
                        "sensor_codename" => "CA",
                        "sensor_serial" => "PZEM14-006",
                    ],[
                        "sensor_codename" => "CD",
                        "sensor_serial" => "KEHAO-006",
                    ],[
                        "sensor_codename" => "Flujo",
                        "sensor_serial" => "HUAIBEI-006",
                    ]
                ]
            ],[
                "block_serial" => "WF13-ES22-07",
                "sender_serial" => "jot00020",
                "user_id" => [1,2,3,11],
                "sensors_data" => [
                    [
                        "sensor_codename" => "PH",
                        "sensor_serial" => "22110776-PH",
                    ],[
                        "sensor_codename" => "TMP",
                        "sensor_serial" => "22110776-TMP",
                    ],[
                        "sensor_codename" => "CR",
                        "sensor_serial" => "22110139",
                    ],[
                        "sensor_codename" => "CA",
                        "sensor_serial" => "PZEM14-007",
                    ],[
                        "sensor_codename" => "CD",
                        "sensor_serial" => "KEHAO-007",
                    ],[
                        "sensor_codename" => "Flujo",
                        "sensor_serial" => "HUAIBEI-007",
                    ]
                ]
            ],[
                "block_serial" => "WF13-ES22-08",
                "sender_serial" => "jot00021",
                "user_id" => [1,2,3,12],
                "sensors_data" => [
                    [
                        "sensor_codename" => "PH",
                        "sensor_serial" => "22110768-PH",
                    ],[
                        "sensor_codename" => "TMP",
                        "sensor_serial" => "22110768-TMP",
                    ],[
                        "sensor_codename" => "CR",
                        "sensor_serial" => "22110144",
                    ],[
                        "sensor_codename" => "CA",
                        "sensor_serial" => "PZEM14-008",
                    ],[
                        "sensor_codename" => "CD",
                        "sensor_serial" => "KEHAO-008",
                    ],[
                        "sensor_codename" => "Flujo",
                        "sensor_serial" => "HUAIBEI-008",
                    ]
                ]
            ],[
                "block_serial" => "WF13-ES22-09",
                "sender_serial" => "jot00022",
                "user_id" => [1,2,3,13],
                "sensors_data" => [
                    [
                        "sensor_codename" => "PH",
                        "sensor_serial" => "22110759-PH",
                    ],[
                        "sensor_codename" => "TMP",
                        "sensor_serial" => "22110759-TMP",
                    ],[
                        "sensor_codename" => "CR",
                        "sensor_serial" => "22110136",
                    ],[
                        "sensor_codename" => "CA",
                        "sensor_serial" => "PZEM14-009",
                    ],[
                        "sensor_codename" => "CD",
                        "sensor_serial" => "KEHAO-009",
                    ],[
                        "sensor_codename" => "Flujo",
                        "sensor_serial" => "HUAIBEI-009",
                    ]
                ]
            ],[
                "block_serial" => "WF13-ES22-10",
                "sender_serial" => "jot00023",
                "user_id" => [1,2,3,14],
                "sensors_data" => [
                    [
                        "sensor_codename" => "PH",
                        "sensor_serial" => "22110773-PH",
                    ],[
                        "sensor_codename" => "TMP",
                        "sensor_serial" => "22110773-TMP",
                    ],[
                        "sensor_codename" => "CR",
                        "sensor_serial" => "22110138",
                    ],[
                        "sensor_codename" => "CA",
                        "sensor_serial" => "PZEM14-010",
                    ],[
                        "sensor_codename" => "CD",
                        "sensor_serial" => "KEHAO-010",
                    ],[
                        "sensor_codename" => "Flujo",
                        "sensor_serial" => "HUAIBEI-010",
                    ]
                ]
            ],[
                "block_serial" => "WF13-ES22-11",
                "sender_serial" => "jot00024",
                "user_id" => [1,2,3,15],
                "sensors_data" => [
                    [
                        "sensor_codename" => "PH",
                        "sensor_serial" => "22110763-PH",
                    ],[
                        "sensor_codename" => "TMP",
                        "sensor_serial" => "22110763-TMP",
                    ],[
                        "sensor_codename" => "CR",
                        "sensor_serial" => "22110141",
                    ],[
                        "sensor_codename" => "CA",
                        "sensor_serial" => "PZEM14-011",
                    ],[
                        "sensor_codename" => "CD",
                        "sensor_serial" => "KEHAO-011",
                    ],[
                        "sensor_codename" => "Flujo",
                        "sensor_serial" => "HUAIBEI-011",
                    ]
                ]
            ],[
                "block_serial" => "WF13-ES22-12",
                "sender_serial" => "jot00025",
                "user_id" => [1,2,3,16],
                "sensors_data" => [
                    [
                        "sensor_codename" => "PH",
                        "sensor_serial" => "22110764-PH",
                    ],[
                        "sensor_codename" => "TMP",
                        "sensor_serial" => "22110764-TMP",
                    ],[
                        "sensor_codename" => "CR",
                        "sensor_serial" => "22110140",
                    ],[
                        "sensor_codename" => "CA",
                        "sensor_serial" => "PZEM14-012",
                    ],[
                        "sensor_codename" => "CD",
                        "sensor_serial" => "KEHAO-012",
                    ],[
                        "sensor_codename" => "Flujo",
                        "sensor_serial" => "HUAIBEI-012",
                    ]
                ]
            ],[
                "block_serial" => "WF13-ES22-13",
                "sender_serial" => "jot00026",
                "user_id" => [1,2,3,17],
                "sensors_data" => [
                    [
                        "sensor_codename" => "PH",
                        "sensor_serial" => "22110771-PH",
                    ],[
                        "sensor_codename" => "TMP",
                        "sensor_serial" => "22110771-TMP",
                    ],[
                        "sensor_codename" => "CR",
                        "sensor_serial" => "22110135",
                    ],[
                        "sensor_codename" => "CA",
                        "sensor_serial" => "PZEM14-013",
                    ],[
                        "sensor_codename" => "CD",
                        "sensor_serial" => "KEHAO-013",
                    ],[
                        "sensor_codename" => "Flujo",
                        "sensor_serial" => "HUAIBEI-013",
                    ]
                ]
            ],[
                "block_serial" => "WF13-ES22-14",
                "sender_serial" => "jot00027",
                "user_id" => [1,2,3,18],
                "sensors_data" => [
                    [
                        "sensor_codename" => "PH",
                        "sensor_serial" => "22110766-PH",
                    ],[
                        "sensor_codename" => "TMP",
                        "sensor_serial" => "22110766-TMP",
                    ],[
                        "sensor_codename" => "CR",
                        "sensor_serial" => "22110143",
                    ],[
                        "sensor_codename" => "CA",
                        "sensor_serial" => "PZEM14-014",
                    ],[
                        "sensor_codename" => "CD",
                        "sensor_serial" => "KEHAO-014",
                    ],[
                        "sensor_codename" => "Flujo",
                        "sensor_serial" => "HUAIBEI-014",
                    ]
                ]
            ],[
                "block_serial" => "WF13-ES22-15",
                "sender_serial" => "jot00028",
                "user_id" => [1,2,3,19],
                "sensors_data" => [
                    [
                        "sensor_codename" => "PH",
                        "sensor_serial" => "22110758-PH",
                    ],[
                        "sensor_codename" => "TMP",
                        "sensor_serial" => "22110758-TMP",
                    ],[
                        "sensor_codename" => "CR",
                        "sensor_serial" => "22110133",
                    ],[
                        "sensor_codename" => "CA",
                        "sensor_serial" => "PZEM14-015",
                    ],[
                        "sensor_codename" => "CD",
                        "sensor_serial" => "KEHAO-015",
                    ],[
                        "sensor_codename" => "Flujo",
                        "sensor_serial" => "HUAIBEI-015",
                    ]
                ]
            ],[
                "block_serial" => "WF13-ES22-16",
                "sender_serial" => "jot00029",
                "user_id" => [1,2,3,20],
                "sensors_data" => [
                    [
                        "sensor_codename" => "PH",
                        "sensor_serial" => "22110772-PH",
                    ],[
                        "sensor_codename" => "TMP",
                        "sensor_serial" => "22110772-TMP",
                    ],[
                        "sensor_codename" => "CR",
                        "sensor_serial" => "22110142",
                    ],[
                        "sensor_codename" => "CA",
                        "sensor_serial" => "PZEM14-016",
                    ],[
                        "sensor_codename" => "CD",
                        "sensor_serial" => "KEHAO-016",
                    ],[
                        "sensor_codename" => "Flujo",
                        "sensor_serial" => "HUAIBEI-016",
                    ]
                ]
            ],[
                "block_serial" => "WF13-ES22-17",
                "sender_serial" => "jot00030",
                "user_id" => [1,2],
                "sensors_data" => [
                    [
                        "sensor_codename" => "PH",
                        "sensor_serial" => "221107-PH",
                    ],[
                        "sensor_codename" => "TMP",
                        "sensor_serial" => "221107-TMP",
                    ],[
                        "sensor_codename" => "CR",
                        "sensor_serial" => "22110134",
                    ],[
                        "sensor_codename" => "CA",
                        "sensor_serial" => "PZEM14-017",
                    ],[
                        "sensor_codename" => "CD",
                        "sensor_serial" => "KEHAO-017",
                    ],[
                        "sensor_codename" => "Flujo",
                        "sensor_serial" => "HUAIBEI-017",
                    ]
                ]
            ]
        ];

        foreach($lista as $estacion){
            self::creacion_estacion_WF13ES22($estacion);
        }

    }

    static public function creacion_estacion_WF13ES22 ( $lista ) {
        $now = date("Y-m-d h:i:s");

        $block_data = [
            "psis_block_type" => '000001',
            "block_codename" => $lista["block_serial"],
            "block_name" => $lista["block_serial"],
            "block_serial" => $lista["block_serial"],
            "block_latitude" => -11.9273733,
            "block_longitude" => -77.0604119,
            "parent_block_id" => 3,
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
                "sm_id" => 1,
                "sensor_codename" => "PH",
                "parameter_id" => 1,
                "up_danger_limit" => 14,
                "up_risk_limit" => 14,
                "ss_channel" => "MDR2"
            ],
            "TMP" => [
                "sm_id" => 2,
                "sensor_codename" => "TMP",
                "parameter_id" => 4,
                "up_danger_limit" => 60,
                "up_risk_limit" => 60,
                "ss_channel" => "MDR1"
            ],
            "CR" => [
                "sm_id" => 3,
                "sensor_codename" => "CR",
                "parameter_id" => 7,
                "up_danger_limit" => 20,
                "up_risk_limit" => 20,
                "ss_channel" => "MDR0"
            ],
            "CA" => [
                "sm_id" => 4,
                "sensor_codename" => "CA",
                "parameter_id" => 14,
                "up_danger_limit" => 10,
                "up_risk_limit" => 10,
                "ss_channel" => "MDR3"
            ],
            "CD" => [
                "sm_id" => 5,
                "sensor_codename" => "CD",
                "parameter_id" => 15,
                "up_danger_limit" => 5000,
                "up_risk_limit" => 5000,
                "ss_channel" => "AI1"
            ],
            "Flujo" => [
                "sm_id" => 6,
                "sensor_codename" => "Flujo",
                "parameter_id" => 9,
                "up_danger_limit" => 645,
                "up_risk_limit" => 645,
                "ss_channel" => "AI0"
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
            SensorSender::create($sensor_sender_data_tmp);

            $sender_block_data["block_id"] = $block->block_id;
            $sender_block_data["sender_id"] = $sender->sender_id;
            SenderBlock::create($sender_block_data);

        }

    }
}
