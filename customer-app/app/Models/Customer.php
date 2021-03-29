<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    
    
    public static function sortCSVFile(){
        $titles = array("Mr", "Mister", "Mrs", "Miss", "Ms", "Dr", "Prof", "Reverend", "Sir");



        $customerList = array();
        $customerCSV = $_FILES["file"]["tmp_name"];
        
        if ($_FILES["file"]["size"] > 0) {
            $file = fopen($customerCSV, "r");
            $is_header = true;
            while (($customers = fgetcsv($file, 10000, ",")) !== FALSE) {
                if (!$is_header){
                    $customersLine = explode(" ", $customers[0]);
                    $title1="";
                    $first_name1="";
                    $initial1="";
                    $last_name1="";
                    $title2="";
                    $first_name2="";
                    $initial2="";
                    $last_name2="";
                    $isMultiple = false;

                    foreach($customersLine as $customer ){
                        str_replace("."," ",$customer);

                        if($customer == "and" || $customer == "&"){
                            $isMultiple = true;
                        }elseif(in_array($customer, $titles)){
                            if($title1 && $isMultiple){
                                $title2 = $customer;
                            }else{
                                $title1 = $customer;
                            }
                        }elseif(strlen($customer) == 1){
                            if($initial1 && $isMultiple){
                                $initial2 = $customer;
                            }else{
                                $initial1 = $customer;
                            }
                        }else{
                            if($initial1){
                                if($last_name1 && $isMultiple){
                                    $last_name2 = $customer;
                                }else{
                                    $last_name1 = $customer;
                                }
                            }else{
                                if($first_name1){
                                    if($isMultiple){
                                        if($last_name1){
                                            $last_name2 = $customer;
                                        }else{
                                            $last_name1 = $customer;
                                        }
                                    }else{
                                        if($first_name1){
                                            $last_name1=$customer;
                                        }else{
                                            $first_name1 = $customer;
                                        }
                                    }
                                }else{
                                    $first_name1 = $customer;
                                }
                            }
                        }
                    }

                    $customerList[] = array(
                        'title'=>$title1,
                        'first_name'=>$first_name1,
                        'initial'=>$initial1,
                        'last_name'=>$last_name1
                    );
                    if($isMultiple){

                        if(!$last_name2){
                            $last_name2=$last_name1;
                        }

                        $customerList[] = array(
                            'title'=>$title2,
                            'first_name'=>$first_name2,
                            'initial'=>$initial2,
                            'last_name'=>$last_name2
                        );
                    }
                    
                }else{
                    $is_header = false;
                }

            }

        }else{
            echo "HAS NO FILES";
            return;

        }

        return $customerList;
    }

}