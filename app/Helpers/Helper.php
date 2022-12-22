<?php

namespace App\Helpers;

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
        if ($spiritual == 'Sangat Baik' && $sosial == 'Sangat Baik' && $akademik == 'Sangat Baik' && $ekstrakurikuler == 'Sangat Baik') {
            $message = 'Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Sangat Baik' && $akademik == 'Sangat Baik' && $ekstrakurikuler == 'Baik') {
            $message = 'Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Sangat Baik' && $akademik == 'Sangat Baik' && $ekstrakurikuler == 'Cukup') {
            $message = 'Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Sangat Baik' && $akademik == 'Sangat Baik' && $ekstrakurikuler == 'Perlu Bimbingan') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Sangat Baik' && $akademik == 'Baik' && $ekstrakurikuler == 'Sangat Baik') {
            $message = 'Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Sangat Baik' && $akademik == 'Baik' && $ekstrakurikuler == 'Baik') {
            $message = 'Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Sangat Baik' && $akademik == 'Baik' && $ekstrakurikuler == 'Cukup') {
            $message = 'Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Sangat Baik' && $akademik == 'Baik' && $ekstrakurikuler == 'Perlu Bimbingan') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Sangat Baik' && $akademik == 'Cukup' && $ekstrakurikuler == 'Sangat Baik') {
            $message = 'Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Sangat Baik' && $akademik == 'Cukup' && $ekstrakurikuler == 'Baik') {
            $message = 'Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Sangat Baik' && $akademik == 'Cukup' && $ekstrakurikuler == 'Cukup') {
            $message = 'Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Sangat Baik' && $akademik == 'Cukup' && $ekstrakurikuler == 'Perlu Bimbingan') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Sangat Baik' && $akademik == 'Perlu Bimbingan' && $ekstrakurikuler == 'Sangat Baik') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Sangat Baik' && $akademik == 'Perlu Bimbingan' && $ekstrakurikuler == 'Baik') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Sangat Baik' && $akademik == 'Perlu Bimbingan' && $ekstrakurikuler == 'Cukup') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Sangat Baik' && $akademik == 'Perlu Bimbingan' && $ekstrakurikuler == 'Perlu Bimbingan') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Baik' && $akademik == 'Sangat Baik' && $ekstrakurikuler == 'Sangat Baik') {
            $message = 'Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Baik' && $akademik == 'Sangat Baik' && $ekstrakurikuler == 'Baik') {
            $message = 'Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Baik' && $akademik == 'Sangat Baik' && $ekstrakurikuler == 'Cukup') {
            $message = 'Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Baik' && $akademik == 'Sangat Baik' && $ekstrakurikuler == 'Perlu Bimbingan') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Baik' && $akademik == 'Baik' && $ekstrakurikuler == 'Sangat Baik') {
            $message = 'Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Baik' && $akademik == 'Baik' && $ekstrakurikuler == 'Baik') {
            $message = 'Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Baik' && $akademik == 'Baik' && $ekstrakurikuler == 'Cukup') {
            $message = 'Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Baik' && $akademik == 'Baik' && $ekstrakurikuler == 'Perlu Bimbingan') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Baik' && $akademik == 'Cukup' && $ekstrakurikuler == 'Sangat Baik') {
            $message = 'Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Baik' && $akademik == 'Cukup' && $ekstrakurikuler == 'Baik') {
            $message = 'Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Baik' && $akademik == 'Cukup' && $ekstrakurikuler == 'Cukup') {
            $message = 'Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Baik' && $akademik == 'Cukup' && $ekstrakurikuler == 'Perlu Bimbingan') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Baik' && $akademik == 'Perlu Bimbingan' && $ekstrakurikuler == 'Sangat Baik') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Baik' && $akademik == 'Perlu Bimbingan' && $ekstrakurikuler == 'Baik') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Baik' && $akademik == 'Perlu Bimbingan' && $ekstrakurikuler == 'Cukup') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Baik' && $akademik == 'Perlu Bimbingan' && $ekstrakurikuler == 'Perlu Bimbingan') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Cukup' && $akademik == 'Sangat Baik' && $ekstrakurikuler == 'Sangat Baik') {
            $message = 'Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Cukup' && $akademik == 'Sangat Baik' && $ekstrakurikuler == 'Baik') {
            $message = 'Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Cukup' && $akademik == 'Sangat Baik' && $ekstrakurikuler == 'Cukup') {
            $message = 'Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Cukup' && $akademik == 'Sangat Baik' && $ekstrakurikuler == 'Perlu Bimbingan') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Cukup' && $akademik == 'Baik' && $ekstrakurikuler == 'Sangat Baik') {
            $message = 'Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Cukup' && $akademik == 'Baik' && $ekstrakurikuler == 'Baik') {
            $message = 'Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Cukup' && $akademik == 'Baik' && $ekstrakurikuler == 'Cukup') {
            $message = 'Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Cukup' && $akademik == 'Baik' && $ekstrakurikuler == 'Perlu Bimbingan') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Cukup' && $akademik == 'Cukup' && $ekstrakurikuler == 'Sangat Baik') {
            $message = 'Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Cukup' && $akademik == 'Cukup' && $ekstrakurikuler == 'Baik') {
            $message = 'Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Cukup' && $akademik == 'Cukup' && $ekstrakurikuler == 'Cukup') {
            $message = 'Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Cukup' && $akademik == 'Cukup' && $ekstrakurikuler == 'Perlu Bimbingan') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Cukup' && $akademik == 'Perlu Bimbingan' && $ekstrakurikuler == 'Sangat Baik') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Cukup' && $akademik == 'Perlu Bimbingan' && $ekstrakurikuler == 'Baik') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Cukup' && $akademik == 'Perlu Bimbingan' && $ekstrakurikuler == 'Cukup') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Cukup' && $akademik == 'Perlu Bimbingan' && $ekstrakurikuler == 'Perlu Bimbingan') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Perlu Bimbingan' && $akademik == 'Sangat Baik' && $ekstrakurikuler == 'Sangat Baik') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Perlu Bimbingan' && $akademik == 'Sangat Baik' && $ekstrakurikuler == 'Baik') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Perlu Bimbingan' && $akademik == 'Sangat Baik' && $ekstrakurikuler == 'Cukup') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Perlu Bimbingan' && $akademik == 'Sangat Baik' && $ekstrakurikuler == 'Perlu Bimbingan') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Perlu Bimbingan' && $akademik == 'Baik' && $ekstrakurikuler == 'Sangat Baik') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Perlu Bimbingan' && $akademik == 'Baik' && $ekstrakurikuler == 'Baik') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Perlu Bimbingan' && $akademik == 'Baik' && $ekstrakurikuler == 'Cukup') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Perlu Bimbingan' && $akademik == 'Baik' && $ekstrakurikuler == 'Perlu Bimbingan') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Perlu Bimbingan' && $akademik == 'Cukup' && $ekstrakurikuler == 'Sangat Baik') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Perlu Bimbingan' && $akademik == 'Cukup' && $ekstrakurikuler == 'Baik') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Perlu Bimbingan' && $akademik == 'Cukup' && $ekstrakurikuler == 'Cukup') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Perlu Bimbingan' && $akademik == 'Cukup' && $ekstrakurikuler == 'Perlu Bimbingan') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Perlu Bimbingan' && $akademik == 'Perlu Bimbingan' && $ekstrakurikuler == 'Sangat Baik') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Perlu Bimbingan' && $akademik == 'Perlu Bimbingan' && $ekstrakurikuler == 'Baik') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Perlu Bimbingan' && $akademik == 'Perlu Bimbingan' && $ekstrakurikuler == 'Cukup') {
            $message = 'Tidak Berprestasi';
        } else if ($spiritual == 'Sangat Baik' && $sosial == 'Perlu Bimbingan' && $akademik == 'Perlu Bimbingan' && $ekstrakurikuler == 'Perlu Bimbingan') {
            $message = 'Tidak Berprestasi';
        }

        return $message;
    }
}
