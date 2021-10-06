                    <div id="onoff_pack">
                        <?php 
                        use admin\Http\Controllers\AppUsersCtrl;
                        use admin\Http\Controllers\Clients\ClientsCtrl;
                            $id= $prod_service->pack_id;
                            if(Auth::user()->is_admin===1){
                            $obj= new AppUsersCtrl;
                            $pack= $obj->pack_detail($id);                                
                            }
                            else{
                            $obj= new ClientsCtrl;
                            $pack= $obj->pack_detail($id);                                 
                            }

                        ?>
                        <div class="form-group">
                            <label>Service like to have:
                            </label> Onn-off packages digital audit & interview
                        </div>                          

                        <div class="form-group">
                            <label>What we do for you?:
                            </label> 
                            {{$pack->title}}<br>
                            ${{$pack->price}}<br>
                            {{$pack->category}}<br>
                            {{$pack->description}}

                        </div>                         

                    </div>    