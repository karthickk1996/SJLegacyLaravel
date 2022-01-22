@php
    $form = \App\Models\Form::where('form_type',$data->hasMirrorWill ? 'mirror-will' : 'single-will' )->first();
    $content = $form->content;

    if(strpos($content, '{1}') !== false){
       $content = str_replace('{1}',$data->firstName . ' ' . $data->middleName . ' ' . $data->lastName,$content);
    }

    if(strpos($content, '{2}') !== false){
       $content = str_replace('{2}',$data->email,$content);
    }

    if(strpos($content, '{7}') !== false){
       $content = str_replace('{7}',\Carbon\Carbon::parse($data->dob)->toFormattedDateString(),$content);
    }

    if(strpos($content, '{8}') !== false){
        $address = $data->addressSummary['line1'].' '.$data->addressSummary['line2'].' '.$data->addressSummary['country'].' '.$data->addressSummary['postal'];
       $content = str_replace('{8}',$address,$content);
    }

    if(strpos($content, '{9}') !== false){
        $name = $data->secondApplicant['firstName'].' '.$data->secondApplicant['middleName'].' '.$data->secondApplicant['lastName'];
       $content = str_replace('{9}',$name,$content);
    }

    if(strpos($content, '{10}') !== false){
        $relation = $data->secondApplicant['relation'];
       $content = str_replace('{10}',$relation,$content);
    }

    if(strpos($content, '{11}') !== false){
        $dob = \Carbon\Carbon::parse($data->secondApplicant['dob'])->toFormattedDateString();
       $content = str_replace('{11}',$dob,$content);
    }

    if(strpos($content, '{12}') !== false){
        $address = $data->secondApplicant['line1'].' '.$data->secondApplicant['line2'].' '.$data->secondApplicant['country'].' '.$data->secondApplicant['postal'];
       $content = str_replace('{12}',$address,$content);
    }

    if(strpos($content, '{14}') !== false){
        $executor = $data->executor;
        if($executor){
            $executorName = $data->executor[0]['firstName'].' '.$data->executor[0]['middleName'].' '.$data->executor[0]['lastName'];
            $content = str_replace('{14}',$executorName,$content);
        }
    }

    if(strpos($content, '{15}') !== false){
        $executor = $data->executor;
        if($executor){
            $relation = $data->executor[0]['relation'];
            $content = str_replace('{15}',$relation,$content);
        }
    }

    if(strpos($content, '{16}') !== false){
        $executor = $data->executor;
        if($executor){
            $address = $data->executor[0]['line1'].' '.$data->executor[0]['line2'].' '.$data->executor[0]['country'].' '.$data->executor[0]['postal'];
            $content = str_replace('{16}',$address,$content);
        }
    }

    if(strpos($content, '{17}') !== false){
        $executor = $data->reserveExecutor;
        if($executor){
            $executorName = $data->reserveExecutor[0]['firstName'].' '.$data->reserveExecutor[0]['middleName'].' '.$data->reserveExecutor[0]['lastName'];
            $content = str_replace('{17}',$executorName,$content);
        }
    }

    if(strpos($content, '{19}') !== false){
        $executor = $data->reserveExecutor;
        if($executor){
            $executorName = $data->reserveExecutor[0]['secondApplicantRelation'];
            $content = str_replace('{19}',$executorName,$content);
        }
    }

    if(strpos($content, '{20}') !== false){
        $executor = $data->reserveExecutor;
        if($executor){
            $address = $data->reserveExecutor[0]['line1'].' '.$data->reserveExecutor[0]['line2'].' '.$data->reserveExecutor[0]['country'].' '.$data->reserveExecutor[0]['postal'];
            $content = str_replace('{20}',$address,$content);
        }else{
            $content = str_replace('{20}','',$content);
        }
    }



@endphp

{!! $content !!}
