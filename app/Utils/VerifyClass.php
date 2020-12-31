<?php 
    foreach ($viewVars as $key => $id) 
    {
        
        if ($key='id_type') 
        {   
            if (!empty($id)) 
            {
                $productType=new Type();
                $test=$productType->typeById($id);
                //var_dump($test) ;
                //$name=$productType->nameType($id);
                //$name=$name['0'];
                //var_dump($name);
                return $test;
            }
        }
        elseif ($key='id_category')
        {   
            if (!empty($id)) 
            {
                $productCategory=new Category();
                $test=$productCategory->categoryById($id);
                // var_dump($test) ;
                return $test;
            }
        }
        elseif ($key='id_brand')
        {    
            if (!empty($id)) 
            {
                $productBrand=new Brand();
                $test=$productBrand->brandById($id);
                // var_dump($test) ;
                //$name=$productBrand->nameBrand($id);
                //$name=$name['0'];
                return $test;
            }
        }
    }
