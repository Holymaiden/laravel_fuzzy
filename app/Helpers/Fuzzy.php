<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class Fuzzy
{
        // Define membership functions for each input and output variable
        public static function spiritual_sangat_baik($x)
        {
                if ($x <= 2) {
                        return 0;
                } else if (2 <= $x && $x <= 4) {
                        return ($x - 2) / (4 - 2);
                } else if ($x >= 4) {
                        return 1;
                } else {
                        return 0;
                }
        }

        public static function spiritual_perlu_bimbingan($x)
        {
                if (1 <= $x && $x <= 3) {
                        return (3 - $x) / (3 - 1);
                } else if ($x >= 3) {
                        return 0;
                } else {
                        return 0;
                }
        }

        public static function sosial_sangat_baik($x)
        {
                if ($x <= 2) {
                        return 0;
                } else if (2 <= $x && $x <= 4) {
                        return ($x - 2) / (4 - 2);
                } else if ($x >= 4) {
                        return 1;
                } else {
                        return 0;
                }
        }

        public static function sosial_perlu_bimbingan($x)
        {
                if (1 <= $x && $x <= 3) {
                        return (3 - $x) / (3 - 1);
                } else if ($x >= 3) {
                        return 0;
                } else {
                        return 0;
                }
        }

        public static function pengetahuan_sangat_baik($x)
        {
                if ($x <= 83) {
                        return 0;
                } else if (83 <= $x && $x <= 100) {
                        return ($x - 83) / (100 - 83);
                } else if ($x >= 100) {
                        return 1;
                } else {
                        return 0;
                }
        }

        public static function pengetahuan_baik($x)
        {
                if ($x <= 69 || $x >= 97) {
                        return 0;
                } else if (69 <= $x && $x <= 83) {
                        return ($x - 69) / (83 - 69);
                } else if (83 <= $x && $x <= 97) {
                        return (97 - $x) / (97 - 83);
                } else {
                        return 0;
                }
        }

        public static function pengetahuan_cukup($x)
        {
                if ($x <= 55 || $x >= 83) {
                        return 0;
                } else if (55 <= $x && $x <= 69) {
                        return ($x - 55) / (69 - 55);
                } else if (69 <= $x && $x <= 83) {
                        return (83 - $x) / (83 - 69);
                } else {
                        return 0;
                }
        }

        public static function pengetahuan_perlu_bimbingan($x)
        {
                if (0 <= $x && $x <= 69) {
                        return (69 - $x) / (69 - 0);
                } else if ($x >= 69) {
                        return 0;
                } else {
                        return 0;
                }
        }

        public static function keterampilan_sangat_baik($x)
        {
                if ($x <= 83) {
                        return 0;
                } else if (83 <= $x && $x <= 100) {
                        return ($x - 83) / (100 - 83);
                } else if ($x >= 100) {
                        return 1;
                } else {
                        return 0;
                }
        }

        public static function keterampilan_baik($x)
        {
                if ($x <= 70 || $x >= 96) {
                        return 0;
                } else if (70 <= $x && $x <= 83) {
                        return ($x - 70) / (83 - 70);
                } else if (83 <= $x && $x <= 96) {
                        return (96 - $x) / (96 - 83);
                } else {
                        return 0;
                }
        }

        public static function keterampilan_cukup($x)
        {
                if ($x <= 57 || $x >= 83) {
                        return 0;
                } else if (57 <= $x && $x <= 70) {
                        return ($x - 57) / (70 - 57);
                } else if (70 <= $x && $x <= 83) {
                        return (83 - $x) / (83 - 70);
                } else {
                        return 0;
                }
        }

        public static function keterampilan_perlu_bimbingan($x)
        {
                if (0 <= $x && $x <= 70) {
                        return (70 - $x) / (70 - 0);
                } else if ($x >= 70) {
                        return 0;
                } else {
                        return 0;
                }
        }

        public static function achievement_berprestasi($x)
        {
                if ($x <= 70) {
                        return 0;
                } else if (70 <= $x && $x <= 100) {
                        return ($x - 70) / (100 - 70);
                } else if ($x >= 100) {
                        return 1;
                } else {
                        return 0;
                }
        }

        public static function achievement_tidak_berprestasi($x)
        {
                if (0 <= $x && $x <= 77) {
                        return (77 - $x) / (77 - 0);
                } else if ($x >= 77) {
                        return 0;
                } else {
                        return 0;
                }
        }

        // Define function to calculate input membership
        public static function calculate_input_membership($value, $variable)
        {
                $membership = array();
                switch ($variable) {
                        case 'spiritual':
                                $membership['sangat_baik'] = Fuzzy::spiritual_sangat_baik($value);
                                $membership['perlu_bimbingan'] = Fuzzy::spiritual_perlu_bimbingan($value);
                                break;
                        case 'sosial':
                                $membership['sangat_baik'] = Fuzzy::sosial_sangat_baik($value);
                                $membership['perlu_bimbingan'] = Fuzzy::sosial_perlu_bimbingan($value);
                                break;
                        case 'pengetahuan':
                                $membership['sangat_baik'] = Fuzzy::pengetahuan_sangat_baik($value);
                                $membership['baik'] = Fuzzy::pengetahuan_baik($value);
                                $membership['cukup'] = Fuzzy::pengetahuan_cukup($value);
                                $membership['perlu_bimbingan'] = Fuzzy::pengetahuan_perlu_bimbingan($value);
                                break;
                        case 'keterampilan':
                                $membership['sangat_baik'] = Fuzzy::keterampilan_sangat_baik($value);
                                $membership['baik'] = Fuzzy::keterampilan_baik($value);
                                $membership['cukup'] = Fuzzy::keterampilan_cukup($value);
                                $membership['perlu_bimbingan'] = Fuzzy::keterampilan_perlu_bimbingan($value);
                                break;
                }
                return $membership;
        }

        // Define function to calculate output membership
        public static function calculate_output_membership($value)
        {
                $membership = array();
                $membership['berprestasi'] = Fuzzy::achievement_berprestasi($value);
                $membership['tidak_berprestasi'] = Fuzzy::achievement_tidak_berprestasi($value);
                return $membership;
        }

        // Define function to apply fuzzy rules
        public static function apply_fuzzy_rules($input, $rules)
        {
                $outputs = array();
                $output2 = array();
                foreach ($rules as $i => $rule) {
                        // Check if any input membership value is null
                        $null_value_found = false;
                        foreach ($input as $variable => $membership) {
                                if (!isset($membership[$rule[$variable]])) {
                                        $null_value_found = true;
                                        break;
                                }
                        }
                        if ($null_value_found) {
                                continue;
                        }

                        $output_membership = min(
                                $input['spiritual'][$rule['spiritual']],
                                $input['sosial'][$rule['sosial']],
                                $input['pengetahuan'][$rule['pengetahuan']],
                                $input['keterampilan'][$rule['keterampilan']]
                        );
                        if (!array_key_exists($rule['output'], $outputs)) {
                                $outputs[$rule['output']] = 0;
                        }
                        $outputs[$rule['output']] = max($outputs[$rule['output']], $output_membership);

                        $output2[$i]['code'] = 'R' . ($i + 1);
                        $output2[$i]['a'] = $output_membership;
                        if ($rule['output'] == 'berprestasi')
                                $output2[$i]['z'] = ($output_membership * 30) + 70;
                        else
                                $output2[$i]['z'] = 77 - ($output_membership * 77);

                        $output2[$i]['mu'] = max($outputs[$rule['output']], $output_membership);
                }
                return [$outputs, $output2];
        }


        // Define function to defuzzify output
        public static function defuzzify_output($output)
        {
                $achievement = array('berprestasi' => [70, 100], 'tidak_berprestasi' => [0, 77]);

                if (empty($output)) {
                        return 0;
                }
                $sum_of_products = 0;
                $sum_of_memberships = 0;

                foreach ($output as $key => $value) {
                        $sum_of_products += $value * (($achievement[$key][0] + $achievement[$key][1]) / 2);
                        $sum_of_memberships += $value;
                }
                if ($sum_of_memberships == 0) {
                        return null;
                }
                return $sum_of_products / $sum_of_memberships;
        }

        // public static function mamdani($data)
        // {
        //         $dump_data = 0;
        //         foreach ($data as $key => $value) {
        //                 $dump_data += $value['z'];
        //         }
        //         return $dump_data / count($data);
        // }

        public static function integral_konstan($a, $b, $c)
        {
                $integral = $c * ($b - $a);
                return $integral;
        }

        public static function ross_centroid($a, $b, $c)
        {
                $integral = $c * (($b ** 2) - ($a ** 2)) / 2;
                return $integral;
        }

        public static function mamdani($data)
        {
                // mencari titik pusat dari data dalam integral

                // Sort data by z lowest to highest
                usort($data, function ($a, $b) {
                        return $a['z'] <=> $b['z'];
                });

                $a_values = array();
                $z_values = array();
                $count_z = [];
                foreach ($data as $fuzzy_set) {
                        if (!isset($count_z[$fuzzy_set['z']]))
                                $count_z[$fuzzy_set['z']] = 0;
                        $a_values[] = $fuzzy_set['a'];
                        $z_values[] = (int)$fuzzy_set['z'];
                        $count_z[$fuzzy_set['z']] += 1;
                }
                $z_values_new = array();
                $a_values_new = array();
                for ($i = 0; $i < count($z_values); $i++) {
                        if ($count_z[$z_values[$i]] == 1 && $a_values[$i] != 0) {
                                $a_values_new[] = (float)number_format($a_values[$i], 2);
                                $z_values_new[] =  $z_values[$i];
                        }
                }
                // Hapus nilai yang sama

                $upperbound = 0;
                $lowerbound = 0;
                $integral = 0;
                $integral1 = 0;
                $integral2 = 0;
                for ($i = 0; $i < count($a_values_new); $i++) {
                        $a = $a_values_new[$i];
                        if ($i >= (int)(count($a_values_new) / 2)) {
                                $upperbound = $z_values_new[$i + 1] ?? 100;
                                $lowerbound = $z_values_new[$i];
                        } else
                                $upperbound = $z_values_new[$i];


                        $integral1 += Fuzzy::ross_centroid($lowerbound, $upperbound, $a);
                        $integral2 += Fuzzy::integral_konstan($lowerbound, $upperbound, $a);
                        $lowerbound = $upperbound;
                }
                $integral = $integral1 / $integral2;
                // dd($integral1, $integral2, $integral);
                return $integral;
        }

        public static function sugeno($data)
        {
                $a = 0;
                $dump_data = 0;
                foreach ($data as $key => $value) {
                        $a += $value['a'];
                        $dump_data += $value['a'] * $value['z'];
                }
                // Fix  Division by zero
                if ($a == 0) {
                        return 0;
                }

                return $dump_data / $a;
        }

        public static function achievement($data)
        {
                if ($data >= 80 && $data <= 100)
                        return "Berpestasi";
                else
                        return "Tidak Berprestasi";
        }

        public static function fuzzy($data)
        {
                // Define input and output variables and their respective ranges
                $spiritual = array('sangat_baik' => [2, 4], 'perlu_bimbingan' => [1, 3]);
                $sosial = array('sangat_baik' => [2, 4], 'perlu_bimbingan' => [1, 3]);
                $pengetahuan = array('sangat_baik' => [75, 100], 'baik' => [50, 100], 'cukup' => [25, 75], 'perlu_bimbingan' => [0, 50]);
                $keterampilan = array('sangat_baik' => [75, 100], 'baik' => [50, 100], 'cukup' => [25, 75], 'perlu_bimbingan' => [0, 50]);
                $achievement = array('berprestasi' => [65, 100], 'tidak_berprestasi' => [0, 70]);



                // Define fuzzy rules
                $rules = array(
                        array('spiritual' => 'sangat_baik', 'sosial' => 'sangat_baik', 'pengetahuan' => 'baik', 'keterampilan' => 'baik', 'output' => 'berprestasi'),
                        array('spiritual' => 'sangat_baik', 'sosial' => 'sangat_baik', 'pengetahuan' => 'baik', 'keterampilan' => 'cukup', 'output' => 'berprestasi'),
                        array('spiritual' => 'sangat_baik', 'sosial' => 'sangat_baik', 'pengetahuan' => 'cukup', 'keterampilan' => 'baik', 'output' => 'berprestasi'),
                        array('spiritual' => 'sangat_baik', 'sosial' => 'sangat_baik', 'pengetahuan' => 'cukup', 'keterampilan' => 'baik', 'output' => 'tidak_berprestasi'),
                        array('spiritual' => 'sangat_baik', 'sosial' => 'sangat_baik', 'pengetahuan' => 'cukup', 'keterampilan' => 'cukup', 'output' => 'tidak_berprestasi'),
                        array('spiritual' => 'perlu_bimbingan', 'sosial' => 'sangat_baik', 'pengetahuan' => 'cukup', 'keterampilan' => 'cukup', 'output' => 'tidak_berprestasi'),
                        array('spiritual' => 'perlu_bimbingan', 'sosial' => 'perlu_bimbingan', 'pengetahuan' => 'cukup', 'keterampilan' => 'cukup', 'output' => 'tidak_berprestasi'),
                        array('spiritual' => 'perlu_bimbingan', 'sosial' => 'perlu_bimbingan', 'pengetahuan' => 'perlu_bimbingan', 'keterampilan' => 'cukup', 'output' => 'tidak_berprestasi'),
                );



                // Define input values
                $spiritual_value = $data['spiritual'];
                $sosial_value = $data['sosial'];
                $pengetahuan_value = $data['pengetahuan'];
                $keterampilan_value = $data['keterampilan'];

                // Calculate input membership for each variable
                $input = array(
                        'spiritual' => Fuzzy::calculate_input_membership($spiritual_value, 'spiritual'),
                        'sosial' => Fuzzy::calculate_input_membership($sosial_value, 'sosial'),
                        'pengetahuan' => Fuzzy::calculate_input_membership($pengetahuan_value, 'pengetahuan'),
                        'keterampilan' => Fuzzy::calculate_input_membership($keterampilan_value, 'keterampilan')
                );


                // Apply fuzzy rules to calculate output membership
                $output = Fuzzy::apply_fuzzy_rules($input, $rules);

                // Defuzzify output to get final result
                $result = Fuzzy::defuzzify_output($output[0]);

                // Mamdani
                $mamdani = Fuzzy::mamdani($output[1]);

                // Sugeno
                $sugeno = Fuzzy::sugeno($output[1]);

                // Print input and output
                $new_data = [];
                $new_data['spiritual'] = $spiritual_value;
                $new_data['sosial'] = $sosial_value;
                $new_data['pengetahuan'] = $pengetahuan_value;
                $new_data['keterampilan'] = $keterampilan_value;
                $new_data['result'] = $result;
                $new_data['fuzzifikasi'] = $input;
                $new_data['defuzzifikasi'] = $output[1];
                $new_data['rata'] = ($pengetahuan_value + $keterampilan_value) / 2;
                $new_data['mamdani']['nilai'] = $mamdani;
                $new_data['mamdani']['hasil'] = Fuzzy::achievement($mamdani);
                $new_data['sugeno']['nilai'] = $sugeno;
                $new_data['sugeno']['hasil'] = Fuzzy::achievement($sugeno);

                return $new_data;
        }
}
