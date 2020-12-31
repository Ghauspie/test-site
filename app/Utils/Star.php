<?php if ($product->getRate()==1){
                echo '<i class="fa fa-star"></i>';
                echo '<i class="fa fa-star-o"></i>';
                echo '<i class="fa fa-star-o"></i>';
                echo '<i class="fa fa-star-o"></i>';
                echo '<i class="fa fa-star-o"></i>';
                }

                elseif ($product->getRate()==2){
                  echo '<i class="fa fa-star"></i>';
                  echo '<i class="fa fa-star"></i>';
                  echo '<i class="fa fa-star-o"></i>';
                  echo '<i class="fa fa-star-o"></i>';
                  echo '<i class="fa fa-star-o"></i>';
                }

                elseif ($product->getRate()==3){
                  echo '<i class="fa fa-star"></i>';
                  echo '<i class="fa fa-star"></i>';
                  echo '<i class="fa fa-star"></i>';
                  echo '<i class="fa fa-star-o"></i>';
                  echo '<i class="fa fa-star-o"></i>';
                }
                elseif ($product->getRate()==4){
                  echo '<i class="fa fa-star"></i>';
                  echo '<i class="fa fa-star"></i>';
                  echo '<i class="fa fa-star"></i>';
                  echo '<i class="fa fa-star"></i>';
                  echo '<i class="fa fa-star-o"></i>';
                }
                elseif ($product->getRate()==5){
                  echo '<i class="fa fa-star"></i>';
                  echo '<i class="fa fa-star"></i>';
                  echo '<i class="fa fa-star"></i>';
                  echo '<i class="fa fa-star"></i>';
                  echo '<i class="fa fa-star"></i>';
                  }
                else {
                  echo '<i class="fa fa-star-o"></i>';
                  echo '<i class="fa fa-star-o"></i>';
                  echo '<i class="fa fa-star-o"></i>';
                  echo '<i class="fa fa-star-o"></i>';
                  echo '<i class="fa fa-star-o"></i>';
                }
                  ?>