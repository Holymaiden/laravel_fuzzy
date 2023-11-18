<?php

namespace App\Helpers;

use App\Models\Evaluation;
use App\Models\SchoolYear;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class Helper
{
    // get head title tabel
    public static function head($param)
    {
        return ucwords(str_replace('-', ' ', $param));
    }

    // replace spasi
    public static function replace($param)
    {
        return str_replace(' ', '', $param);
    }

    // button create
    public static function btn_create()
    {
        return '<a onclick="createForm()" class="">
                        <button class="btn btn-primary btn-rounded btn-sm">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Add New
                        </button>
                     </a>';
    }

    // get data from tabel
    public static function btn_action($edit, $delete, $id)
    {
        if ($edit == '1') {
            $edit = '<a onclick="editForm(' . $id . ')" class="">
                        <button type="button" class="btn btn-icon btn-round btn-warning btn-sm">
                            <i class="fa fa-pencil-alt"></i>
                        </button>
            </a> ';
        }
        if ($delete == '1') {
            $delete = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $id . '"
               title="Delete" class="deleteData">
                        <button type="button" class="btn btn-icon btn-round btn-danger btn-sm">
                            <i class="fa fa-trash-alt"></i>
                        </button>
            </a>';
        }
        return $edit . $delete;
    }
    // cek data menu role user
    public static function get_data($param)
    {
        $data = DB::table($param)->get();
        return isset($data) ? $data : null;
    }

    public static function arrayToString($param)
    {
        $data = null;
        foreach ($param as $v) {
            if ($data == null) {
                $data = $v;
            } else {
                $data = $data . "," . $v;
            }
        }
        return $data;
    }

    public static function getSetting($field)
    {
        $data = DB::table('settings')->first();
        return $data->$field ?? null;
    }


    public static function get_school_year()
    {
        $school_year = SchoolYear::get()->unique('name');
        return $school_year;
    }

    public static function statisticData()
    {
        $data_dump = Student::whereHas('value')->with('value')->get();

        // Fuzzy Mamdani
        $fuzzy = [];
        foreach ($data_dump as $key => $value) {
            if ($value->value->evaluation->count() >= 1) {

                // Value
                $fuzzy[$key]['value'] = $value->value->evaluation;

                // Total
                $fuzzy[$key]['total'] = ($fuzzy[$key]['value'][0]['value'] + $fuzzy[$key]['value'][1]['value'] + $fuzzy[$key]['value'][2]['value'] + $fuzzy[$key]['value'][3]['value']) / 4;
            }
        }

        // Grouping in total
        $grouping = [];
        foreach ($fuzzy as $key => $value) {
            if (in_array($value['total'], array_keys($grouping))) {
                $grouping[$value['total']]['value'] += 1;
            } else {
                $grouping[$value['total']]['value'] = 1;
            }
        }

        // desc
        krsort($grouping);

        // arr key
        $arr_key = array_keys($grouping);

        // arr value
        $arr_value = array_column($grouping, 'value');

        // menggabungkan 2 array
        $arr = array_merge($arr_key, $arr_value);

        return Helper::arrayToString($arr);
    }

    public static function rule($spiritual, $sosial, $akademik, $ekstrakurikuler)
    {
        /* 
        option rule mamdani
        1. Sangat Baik
        2. Baik
        3. Cukup
        4. Perlu Bimbingan

        Message
        1. Berprestasi
        2. Tidak Berprestasi
        */
        $message = '';

        if ($spiritual == 'Sangat Baik') {
            if ($sosial == 'Sangat Baik') {
                if ($akademik == 'Sangat Baik') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Baik') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Cukup') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Perlu Bimbingan') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak BerBerprestasi';
                    }
                }
            } else if ($sosial == 'Baik') {
                if ($akademik == 'Sangat Baik') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Baik') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Cukup') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Perlu Bimbingan') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                }
            } else if ($sosial == 'Cukup') {
                if ($akademik == 'Sangat Baik') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Baik') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Cukup') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Perlu Bimbingan') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                }
            } else if ($sosial == 'Perlu Bimbingan') {
                if ($akademik == 'Sangat Baik') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Baik') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Cukup') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Perlu Bimbingan') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                }
            }
        } else if ($spiritual == 'Baik') {
            if ($sosial == 'Sangat Baik') {
                if ($akademik == 'Sangat Baik') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Baik') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Cukup') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Perlu Bimbingan') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                }
            } else if ($sosial == 'Baik') {
                if ($akademik == 'Sangat Baik') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Baik') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Cukup') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Perlu Bimbingan') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                }
            } else if ($sosial == 'Cukup') {
                if ($akademik == 'Sangat Baik') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Baik') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Cukup') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Perlu Bimbingan') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                }
            } else if ($sosial == 'Perlu Bimbingan') {
                if ($akademik == 'Sangat Baik') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Baik') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Cukup') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Perlu Bimbingan') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                }
            }
        } else if ($spiritual == 'Cukup') {
            if ($sosial == 'Sangat Baik') {
                if ($akademik == 'Sangat Baik') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Baik') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Cukup') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Perlu Bimbingan') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                }
            } else if ($sosial == 'Baik') {
                if ($akademik == 'Sangat Baik') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Baik') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Cukup') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Perlu Bimbingan') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Tidak Berprestasi';
                    }
                }
            } else if ($sosial == 'Cukup') {
                if ($akademik == 'Sangat Baik') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Baik') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Cukup') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Perlu Bimbingan') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                }
            } else if ($sosial == 'Perlu Bimbingan') {
                if ($akademik == 'Sangat Baik') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Baik') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Cukup') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Perlu Bimbingan') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                }
            }
        } else if ($spiritual == 'Perlu Bimbingan') {
            if ($sosial == 'Sangat Baik') {
                if ($akademik == 'Sangat Baik') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Baik') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Cukup') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Perlu Bimbingan') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                }
            } else if ($sosial == 'Baik') {
                if ($akademik == 'Sangat Baik') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Baik') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Cukup') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Perlu Bimbingan') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                }
            } else if ($sosial == 'Cukup') {
                if ($akademik == 'Sangat Baik') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Baik') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Cukup') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Perlu Bimbingan') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                }
            } else if ($sosial == 'Perlu Bimbingan') {
                if ($akademik == 'Sangat Baik') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Baik') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Cukup') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                } else if ($akademik == 'Perlu Bimbingan') {
                    if ($ekstrakurikuler == 'Sangat Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Baik') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Cukup') {
                        $message = 'Tidak Berprestasi';
                    } else if ($ekstrakurikuler == 'Perlu Bimbingan') {
                        $message = 'Tidak Berprestasi';
                    }
                }
            }
        }

        return $message;
    }

    public static function variabel_pengetahuan($x)
    {
        // Perlu Bimbingan 0 - 59, Cukup 60 - 72, Baik 73 - 86, Sangat Baik 87 - 100
        $data = [];
        // Perlu Bimbingan 
        if ($x >= 0 && $x <= 59) {
            $data['perlu_bimbingan'] = (59 - $x) / 59;
        } else if ($x >= 60) {
            $data['perlu_bimbingan'] = 0;
        }

        // Cukup
        if ($x >= 72 || $x <= 60) {
            $data['cukup'] = 0;
        } else if (60 <= $x && $x <= 66) {
            $data['cukup'] = ($x - 60) / 6;
        } else if (66 <= $x && $x <= 72) {
            $data['cukup'] = (66 - $x) / 6;
        }

        // Baik
        if ($x <= 73 || $x >= 86) {
            $data['baik'] = 0;
        } else if (73 <= $x && $x <= 80) {
            $data['baik'] = ($x - 73) / 7;
        } else if (80 <= $x) {
            $data['baik'] = (86 - $x) / 6;
        }

        // Sangat Baik
        if ($x <= 87) {
            $data['sangat_baik'] = 0;
        } else if (87 <= $x && $x < 100) {
            $data['sangat_baik'] = ($x - 87) / 13;
        } else if ($x >= 100) {
            $data['sangat_baik'] = 1;
        }

        return $data;
    }

    public static function variabel_keterampilan($x)
    {
        // Perlu Bimbingan 0 - 59, Cukup 60 - 72, Baik 73 - 86, Sangat Baik 87 - 100
        $data = [];
        // Perlu Bimbingan 
        if ($x >= 0 && $x <= 59) {
            $data['perlu_bimbingan'] = (59 - $x) / 59;
        } else if ($x >= 60) {
            $data['perlu_bimbingan'] = 0;
        }

        // Cukup
        if ($x >= 72 || $x <= 60) {
            $data['cukup'] = 0;
        } else if (60 <= $x && $x <= 66) {
            $data['cukup'] = ($x - 60) / 6;
        } else if (66 <= $x && $x <= 72) {
            $data['cukup'] = (66 - $x) / 6;
        }

        // Baik
        if ($x <= 73 || $x >= 86) {
            $data['baik'] = 0;
        } else if (73 <= $x && $x <= 80) {
            $data['baik'] = ($x - 73) / 7;
        } else if (80 <= $x) {
            $data['baik'] = (86 - $x) / 6;
        }

        // Sangat Baik
        if ($x <= 87) {
            $data['sangat_baik'] = 0;
        } else if (87 <= $x && $x < 100) {
            $data['sangat_baik'] = ($x - 87) / 13;
        } else if ($x >= 100) {
            $data['sangat_baik'] = 1;
        }

        return $data;
    }

    public static function variabel_spiritual($x)
    {
        $data = [];
        if ($x == 4) {
            $data['sangat_baik'] = 1;
        } else {
            $data['sangat_baik'] = 0;
        }

        if ($x == 3) {
            $data['baik'] = 1;
        } else {
            $data['baik'] = 0;
        }

        if ($x == 2) {
            $data['cukup'] = 1;
        } else {
            $data['cukup'] = 0;
        }

        if ($x == 1) {
            $data['perlu_bimbingan'] = 1;
        } else {
            $data['perlu_bimbingan'] = 0;
        }
        return $data;
    }

    public static function variabel_sosial($x)
    {
        $data = [];
        if ($x == 4) {
            $data['sangat_baik'] = 1;
        } else {
            $data['sangat_baik'] = 0;
        }

        if ($x == 3) {
            $data['baik'] = 1;
        } else {
            $data['baik'] = 0;
        }

        if ($x == 2) {
            $data['cukup'] = 1;
        } else {
            $data['cukup'] = 0;
        }

        if ($x == 1) {
            $data['perlu_bimbingan'] = 1;
        } else {
            $data['perlu_bimbingan'] = 0;
        }
        return $data;
    }

    public static function fuzzy_rule($spiritual, $sosial, $pengetahuan, $keterampilan)
    {
        $data = [];
        $data['perlu_bimbingan'] = min($spiritual['perlu_bimbingan'], $sosial['perlu_bimbingan'], $pengetahuan['perlu_bimbingan'], $keterampilan['perlu_bimbingan']);
        $data['cukup'] = min($spiritual['cukup'], $sosial['cukup'], $pengetahuan['cukup'], $keterampilan['cukup']);
        $data['baik'] = min($spiritual['baik'], $sosial['baik'], $pengetahuan['baik'], $keterampilan['baik']);
        $data['sangat_baik'] = min($spiritual['sangat_baik'], $sosial['sangat_baik'], $pengetahuan['sangat_baik'], $keterampilan['sangat_baik']);
        return $data;
    }

    public static function fuzzy($inputVals)
    {
        // Define the input variables and their fuzzy sets
        // Input variables
        $inputVars = array(
            'spiritual' => array(
                'range' => array(1, 4),
                'sets' => array(
                    'sangat_baik' => array(1, 1, 1.5, 2),
                    'baik' => array(1.5, 2, 2, 2.5),
                    'cukup' => array(2, 2.5, 3, 3),
                    'perlu_bimbingan' => array(2.5, 3, 4, 4)
                )
            ),
            'sosial' => array(
                'range' => array(1, 4),
                'sets' => array(
                    'sangat_baik' => array(1, 1, 1.5, 2),
                    'baik' => array(1.5, 2, 2, 2.5),
                    'cukup' => array(2, 2.5, 3, 3),
                    'perlu_bimbingan' => array(2.5, 3, 4, 4)
                )
            ),
            'pengetahuan' => array(
                'range' => array(0, 100),
                'sets' => array(
                    'sangat_baik' => array(87, 100, 100, 100),
                    'baik' => array(73, 86, 86, 87),
                    'cukup' => array(60, 72, 73, 73),
                    'perlu_bimbingan' => array(0, 59, 60, 60)
                )
            ),
            'keterampilan' => array(
                'range' => array(0, 100),
                'sets' => array(
                    'sangat_baik' => array(87, 100, 100, 100),
                    'baik' => array(73, 86, 86, 87),
                    'cukup' => array(60, 72, 73, 73),
                    'perlu_bimbingan' => array(0, 59, 60, 60)
                )
            )
        );

        // Define the output variables and their fuzzy sets
        $outputVars = array(
            'success' => array(
                'range' => array(0, 100),
                'sets' => array(
                    'non-achievers' => array(0, 80),
                    'achievers' => array(81, 100)
                )
            )
        );

        // Fuzzy rules
        $rules = array(
            // If spiritual is sangat_baik and sosial is sangat_baik and pengetahuan is sangat_baik and keterampilan is sangat_baik, then success is achievers
            array(
                'input' => array('spiritual' => 'sangat_baik', 'sosial' => 'sangat_baik', 'pengetahuan' => 'sangat_baik', 'keterampilan' => 'sangat_baik'),
                'output' => array('success' => 'achievers')
            ),
            // If spiritual is sangat_baik and sosial is sangat_baik and pengetahuan is sangat_baik and keterampilan is baik, then success is achievers
            array(
                'input' => array('spiritual' => 'sangat_baik', 'sosial' => 'sangat_baik', 'pengetahuan' => 'sangat_baik', 'keterampilan' => 'baik'),
                'output' => array('success' => 'achievers')
            ),
            // If spiritual is sangat_baik and sosial is sangat_baik and pengetahuan is baik and keterampilan is sangat_baik, then success is achievers
            array(
                'input' => array('spiritual' => 'sangat_baik', 'sosial' => 'sangat_baik', 'pengetahuan' => 'baik', 'keterampilan' => 'sangat_baik'),
                'output' => array('success' => 'achievers')
            ),
            // If spiritual is sangat_baik and sosial is sangat_baik and pengetahuan is baik and keterampilan is baik, then success is achievers
            array(
                'input' => array('spiritual' => 'sangat_baik', 'sosial' => 'sangat_baik', 'pengetahuan' => 'baik', 'keterampilan' => 'baik'),
                'output' => array('success' => 'achievers')
            ),
            // If spiritual is sangat_baik and sosial is baik and pengetahuan is sangat_baik and keterampilan is sangat_baik, then success is achievers
            array(
                'input' => array('spiritual' => 'sangat_baik', 'sosial' => 'baik', 'pengetahuan' => 'sangat_baik', 'keterampilan' => 'sangat_baik'),
                'output' => array('success' => 'achievers')
            ),
            // If spiritual is sangat_baik and sosial is baik and pengetahuan is sangat_baik and keterampilan is baik, then success is achievers
            array(
                'input' => array('spiritual' => 'sangat_baik', 'sosial' => 'baik', 'pengetahuan' => 'sangat_baik', 'keterampilan' => 'baik'),
                'output' => array('success' => 'achievers')
            ),
            // If spiritual is sangat_baik and sosial is baik and pengetahuan is baik and keterampilan is sangat_baik, then success is achievers
            array(
                'input' => array('spiritual' => 'sangat_baik', 'sosial' => 'baik', 'pengetahuan' => 'baik', 'keterampilan' => 'sangat_baik'),
                'output' => array('success' => 'achievers')
            ),
            // If spiritual is sangat_baik and sosial is baik and pengetahuan is baik and keterampilan is baik, then success is achievers
            array(
                'input' => array('spiritual' => 'sangat_baik', 'sosial' => 'baik', 'pengetahuan' => 'baik', 'keterampilan' => 'baik'),
                'output' => array('success' => 'achievers')
            ),
            // If spiritual is baik and sosial is sangat_baik and pengetahuan is sangat_baik and keterampilan is sangat_baik, then success is achievers
            array(
                'input' => array('spiritual' => 'baik', 'sosial' => 'sangat_baik', 'pengetahuan' => 'sangat_baik', 'keterampilan' => 'sangat_baik'),
                'output' => array('success' => 'achievers')
            ),
            // If spiritual is baik and sosial is sangat_baik and pengetahuan is sangat_baik and keterampilan is baik, then success is non-achievers
            array(
                'input' => array('spiritual' => 'baik', 'sosial' => 'sangat_baik', 'pengetahuan' => 'sangat_baik', 'keterampilan' => 'baik'),
                'output' => array('success' => 'non-achievers')
            ),
            // If spiritual is baik and sosial is sangat_baik and pengetahuan is baik and keterampilan is sangat_baik, then success is non-achievers
            array(
                'input' => array('spiritual' => 'baik', 'sosial' => 'sangat_baik', 'pengetahuan' => 'baik', 'keterampilan' => 'sangat_baik'),
                'output' => array('success' => 'non-achievers')
            ),
            // If spiritual is baik and sosial is sangat_baik and pengetahuan is baik and keterampilan is baik, then success is non-achievers
            array(
                'input' => array('spiritual' => 'baik', 'sosial' => 'sangat_baik', 'pengetahuan' => 'baik', 'keterampilan' => 'baik'),
                'output' => array('success' => 'non-achievers')
            ),
            // If spiritual is baik and sosial is baik and pengetahuan is sangat_baik and keterampilan is sangat_baik, then success is non-achievers
            array(
                'input' => array('spiritual' => 'baik', 'sosial' => 'baik', 'pengetahuan' => 'sangat_baik', 'keterampilan' => 'sangat_baik'),
                'output' => array('success' => 'non-achievers')
            ),
            // If spiritual is baik and sosial is baik and pengetahuan is sangat_baik and keterampilan is baik, then success is non-achievers
            array(
                'input' => array('spiritual' => 'baik', 'sosial' => 'baik', 'pengetahuan' => 'sangat_baik', 'keterampilan' => 'baik'),
                'output' => array('success' => 'non-achievers')
            ),
            // If spiritual is baik and sosial is baik and pengetahuan is baik and keterampilan is sangat_baik, then success is non-achievers
            array(
                'input' => array('spiritual' => 'baik', 'sosial' => 'baik', 'pengetahuan' => 'baik', 'keterampilan' => 'sangat_baik'),
                'output' => array('success' => 'non-achievers')
            ),
            // If spiritual is baik and sosial is baik and pengetahuan is baik and keterampilan is baik, then success is non-achievers
            array(
                'input' => array('spiritual' => 'baik', 'sosial' => 'baik', 'pengetahuan' => 'baik', 'keterampilan' => 'baik'),
                'output' => array('success' => 'non-achievers')
            ),
            // If spiritual is cukup and sosial is cukup and pengetahuan is cukup and keterampilan is cukup, then success is need guidance
            array(
                'input' => array('spiritual' => 'cukup', 'sosial' => 'cukup', 'pengetahuan' => 'cukup', 'keterampilan' => 'cukup'),
                'output' => array('success' => 'non-achievers')
            ),
        );

        // Fuzzy Mamdani function
        function fuzzyMamdani($inputVals, $inputVars, $outputVars, $rules)
        {
            $outputVals = array();
            // Fuzzification
            foreach ($inputVals as $inputVar => $inputVal) {
                $fuzzyVals = array();
                foreach ($inputVars[$inputVar] as $fuzzyVar => $fuzzyRange) {
                    if (is_array($fuzzyRange)) {
                        $fuzzyVal = max(0, min(1, ($inputVal - $fuzzyRange[0]) / ($fuzzyRange[1] - $fuzzyRange[0])));
                    } else {
                        $fuzzyVal = ($fuzzyVar == $inputVal) ? 1 : 0;
                    }
                    $fuzzyVals[$fuzzyVar] = $fuzzyVal;
                }
                $inputFuzzyVals[$inputVar] = $fuzzyVals;
            }

            // Rule evaluation
            $ruleFuzzyVals = array();
            foreach ($rules as $rule) {
                $minFuzzyVals = array();
                foreach ($rule as $inputVar => $fuzzyVar) {
                    $minFuzzyVals[] = $inputFuzzyVals[$inputVar][$fuzzyVar];
                }
                $ruleFuzzyVals[] = min($minFuzzyVals);
            }

            // Defuzzification
            foreach ($outputVars as $outputVar => $outputSets) {
                $outputVal = 0;
                $totalFuzzyVal = 0;
                foreach ($outputSets as $outputFuzzyVar => $outputFuzzyRange) {
                    $fuzzyVal = $ruleFuzzyVals[$outputFuzzyVar - 1];
                    $outputVal += $fuzzyVal * (($outputFuzzyRange == 1) ? $outputFuzzyVar : (($outputFuzzyVar - 1) * 0.25 + 1));
                    $totalFuzzyVal += $fuzzyVal;
                }
                $outputVals[$outputVar] = ($totalFuzzyVal == 0) ? null : $outputVal / $totalFuzzyVal;
            }

            return $outputVals;
        }

        $outputVals = fuzzyMamdani($inputVals, $inputVars, $outputVars, $rules);

        return $outputVals;
    }
}
