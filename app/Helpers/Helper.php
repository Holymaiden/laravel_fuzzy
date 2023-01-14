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

    public static function rule_mamdani($spiritual, $sosial, $akademik, $ekstrakurikuler)
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
}
