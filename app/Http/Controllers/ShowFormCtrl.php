<?php

namespace admin\Http\Controllers;

use Illuminate\Http\Request;

class ShowFormCtrl extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function form($hint)
    {
        switch ($hint) {
            case 'turnkey':
                echo 
                '
                    <div id="turnkey">
                        <div class="form-group">
                            <h3>Your company focus<span class="star">*</span>
                            </h3>   
                            <div class="radio">
                                <label>
                                    <input type="radio" name="company_focus"value="D2C" required>
                                    D2C

                                </label>
                            </div>                           <div class="radio">
                                <label>
                                    <input type="radio" name="company_focus"value="B2C">
                                    B2C

                                </label>
                            </div>                           <div class="radio">
                                <label>
                                    <input type="radio" name="company_focus"value="B2B">
                                    B2B
                                </label>
                            </div>                           <div class="radio">
                                <label>
                                    <input type="radio" name="company_focus"value="Fintech">
                                    Fintech
                                </label>
                            </div> 

                            <div class="radio">
                                <label>
                                    <input type="radio" name="company_focus"value="SaaS">
                                    SaaS
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="company_focus"value="Other">
                                    Other
                                </label>
                            </div>                   
                        </div>
                        <!--formgroup end-->
                        <div class="form-group">
                            <h3>Your company niche<span class="star">*</span>
                            </h3>  
 
                            <div class="radio">
                                <label>
                                    <input type="radio" name="company_niche"value="Ecommerce" required>
                                    Ecommerce

                                </label>
                            </div>                           <div class="radio">
                                <label>

                                    <input type="radio" name="company_niche"value="Transportation and delivery">
                                    Transportation and delivery

                                </label>
                            </div>
                          <div class="radio">
                                <label>
                                    <input type="radio" name="company_niche"value="Professional Services">
                                    Professional Services
                                </label>
                            </div>                           <div class="radio">
                                <label>
                                    <input type="radio" name="company_niche"value="Service marketplace">
                                    Service marketplace
                                </label>
                            </div> 
                            <div class="radio">
                                <label>
                                    <input type="radio" name="company_niche"value="Hospitality">
                                    Hospitality
                                </label>
                            </div> 

                            <div class="radio">
                                <label>
                                    <input type="radio" name="company_niche"value="SaaS">
                                    SaaS
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="company_niche"value="Other">
                                    Other
                                </label>
                            </div>                   
                        </div>
                        <!--formgroup end-->
                        <div class="form-group">
                            <h3>Your product/service<span class="star">*</span>
                            </h3>  
 
                            <div class="radio">
                                <label>
                                    <input type="radio" name="product_service"value="Must have daily (uber)" required>
                                    Must have daily (uber)

                                </label>
                            </div>                           <div class="radio">
                                <label>

                                    <input type="radio" name="product_service"value="Must have weekly/monthly (amazon, hellofresh)">
                                    Must have weekly/monthly (amazon, hellofresh)

                                </label>
                            </div>
                          <div class="radio">
                                <label>
                                    <input type="radio" name="product_service"value="Professional Services">
                                    Professional Services
                                </label>
                            </div>                           <div class="radio">
                                <label>
                                    <input type="radio" name="product_service"value="Special occasion or luxury (rent-a-runaway)">
                                    Special occasion or luxury (rent-a-runaway)
                                </label>
                            </div> 
                            <div class="radio">
                                <label>
                                    <input type="radio" name="product_service"value="Nice have (booking.com)">
                                    Nice have (booking.com)
                                </label>
                            </div>                           <div class="radio">
                                <label>
                                    <input type="radio" name="product_service"value="Other">
                                    Other
                                </label>
                            </div> 
                  
                        </div>                        
                        <!--formgroup end-->
                        <div class="form-group">
                            <h3>Your monthly marketing budget<span class="star">*</span>
                            </h3>  
 
                            <div class="radio">
                                <label>
                                    <input type="radio" name="monthly_marketing"value="Less than 2000" required>
                                    Less than 2000
                                </label>
                            </div>                           <div class="radio">
                                <label>

                                    <input type="radio" name="monthly_marketing"value="2000-10000">
                                    2000-10000
                                </label>
                            </div>
                          <div class="radio">
                                <label>
                                    <input type="radio" name="monthly_marketing"value="10000 -50K">
                                    10000 -50K
                                </label>
                            </div>                           <div class="radio">
                                <label>
                                    <input type="radio" name="monthly_marketing"value="50K-100K">
                                    50K-100K
                                </label>
                            </div> 
                            <div class="radio">
                                <label>
                                    <input type="radio" name="monthly_marketing"value="100K-1M">
                                    100K-1M
                                </label>
                            </div>
                  
                        </div>                           
                        <!--formgroup end-->
                        <!--fields start-->
                        <div class="form-group">
                            <label>Name<span class="star">*</span></label>
                            <input class="form-control" name="name" required></input>
                        </div>                        
                        <div class="form-group">
                            <label>Company Name<span class="star">*</span></label>
                            <input class="form-control" name="company_name" required></input>
                        </div>                        
                        <div class="form-group">
                            <label>Company Website</label>
                            <input class="form-control" name="company_website"></input>
                        </div>                        

                        <div class="form-group">
                            <label>Corporate Email<span class="star">*</span></label>
                            <input type="email" class="form-control" name="email" required></input>
                        </div>                        

                        <div class="form-group">
                            <label>Password<span class="star">*</span></label>
                            <input type="password" class="form-control" name="password" required></input>
                        </div>
                        <!--fields end-->
                        
                    </div>
                ';
                break;
            case "top3":
            echo 
            '
    <div id="top3">
        <div class="form-group">
            <h3>Would like to hire<span class="star">*</span></h3>   
            <div class="radio">
                <label>
                <input type="radio" name="hire"value="Paid Social (FB ads, Instagram ads, Snapchat ads)" required>
                Paid Social (FB ads, Instagram ads, Snapchat ads)

                </label>
            </div>                           
            <div class="radio">
                <label>
                <input type="radio" name="hire"value="PPC (google adword)">
                PPC (google adword)

                </label>
            </div>                           
            <div class="radio">
                <label>
                <input type="radio" name="hire"value="SEO and ASO">
                SEO and ASO
                </label>
            </div>                           
            <div class="radio">
                <label>
                <input type="radio" name="hire"value="Web analytics (GA)">
                Web analytics (GA)
                </label>
            </div> 

            <div class="radio">
                <label>
                <input type="radio" name="hire"value="Mobile analytics (Adjsut, Appsflyer)">
                Mobile analytics (Adjsut, Appsflyer)
                </label>
            </div>
            <div class="radio">
                <label>
                <input type="radio" name="hire"value="BI  and data science (PowerBI, SQL, Python)">
                BI  and data science (PowerBI, SQL, Python)
                </label>
            </div>              

            <div class="radio">
                <label>
                <input type="radio" name="hire"value="UI/UX">
                UI/UX
                </label>
            </div>              

            <div class="radio">
                <label>
                <input type="radio" name="hire"value="Graphic Design and animation">
                Graphic Design and animation
                </label>
            </div>              

            <div class="radio">
                <label>
                <input type="radio" name="hire"value="Mobile Product Marketing">
                Mobile Product Marketing
                </label>
            </div>              

            <div class="radio">
                <label>
                <input type="radio" name="hire"value="Interim CMO/CDO">
                Interim CMO/CDO
                </label>
            </div>             

            <div class="radio">
                <label>
                <input type="radio" name="hire"value="CRO">
                CRO
                </label>
            </div>                   
        </div>
        <!--formgroup end-->
        <div class="form-group">
            <h3>Your company focus<span class="star">*</span></h3>   
            <div class="radio">
            <label>
            <input type="radio" name="company_focus"value="D2C" required>
            D2C

            </label>
        </div>                           
        <div class="radio">
            <label>
            <input type="radio" name="company_focus"value="B2C">
            B2C

            </label>
        </div>                           
        <div class="radio">
            <label>
            <input type="radio" name="company_focus"value="B2B">
            B2B
            </label>
        </div>                           
        <div class="radio">
            <label>
            <input type="radio" name="company_focus"value="Fintech">
            Fintech
            </label>
        </div> 

        <div class="radio">
            <label>
            <input type="radio" name="company_focus"value="SaaS">
            SaaS
            </label>
        </div>
        <div class="radio">
            <label>
            <input type="radio" name="company_focus"value="Other">
            Other
            </label>
        </div>                   
    </div>        
        <!--formgroup end-->
        <div class="form-group">
            <h3>Your company niche<span class="star">*</span></h3>  
 
            <div class="radio">
                <label>
                <input type="radio" name="company_niche"value="Ecommerce" required>
                Ecommerce

                </label>
            </div>                           
            <div class="radio">
                <label>

                <input type="radio" name="company_niche"value="Transportation and delivery">
                Transportation and delivery

                </label>
            </div>
            <div class="radio">
                <label>
                <input type="radio" name="company_niche"value="Professional Services">
                Professional Services
                </label>
            </div>                           
            <div class="radio">
                <label>
                <input type="radio" name="company_niche"value="Service marketplace">
                Service marketplace
                </label>
            </div> 
            <div class="radio">
                <label>
                <input type="radio" name="company_niche"value="Hospitality">
                Hospitality
                </label>
            </div> 

            <div class="radio">
                <label>
                <input type="radio" name="company_niche"value="SaaS">
                SaaS
                </label>
            </div>
            <div class="radio">
                <label>
                <input type="radio" name="company_niche"value="Other">
                Other
                </label>
            </div>                   
                        <!--formgroup end-->
        </div>
                        <!--formgroup end-->
        <div class="form-group">
            <h3>Your product/service<span class="star">*</span></h3>  
 
            <div class="radio">
                <label>
                <input type="radio" name="product_service"value="Must have daily (uber)" required>
                Must have daily (uber)

                </label>
            </div>                           
            <div class="radio">
                <label>

                <input type="radio" name="product_service"value="Must have weekly/monthly (amazon, hellofresh)">
                Must have weekly/monthly (amazon, hellofresh)

                </label>
            </div>
            <div class="radio">
                <label>
                <input type="radio" name="product_service"value="Professional Services">
                Professional Services
                </label>
            </div>                           
            <div class="radio">
                <label>
                <input type="radio" name="product_service"value="Special occasion or luxury (rent-a-runaway)">
                Special occasion or luxury (rent-a-runaway)
                </label>
            </div> 
            <div class="radio">
                <label>
                <input type="radio" name="product_service"value="Nice have (booking.com)">
                Nice have (booking.com)
                </label>
            </div>                           
            <div class="radio">
                <label>
                <input type="radio" name="product_service"value="Other">
                Other
                </label>
            </div> 
                  
        </div>  
        <!--form group end-->                      
        <div class="form-group">
            <h3>Your monthly marketing budget<span class="star">*</span></h3>  
 
            <div class="radio">
                <label>
                <input type="radio" name="monthly_marketing"value="Less than 2000" required>
                Less than 2000
                </label>
            </div>                           
            <div class="radio">
                <label>

                <input type="radio" name="monthly_marketing"value="2000-10000">
                2000-10000
                </label>
                </div>
            <div class="radio">
                <label>
                <input type="radio" name="monthly_marketing"value="10000 -50K">
                10000 -50K
                </label>
            </div>                           
            <div class="radio">
                <label>
                <input type="radio" name="monthly_marketing"value="50K-100K">
                50K-100K
                </label>
            </div> 
            <div class="radio">
                <label>
                <input type="radio" name="monthly_marketing"value="100K-1M">
                100K-1M
                </label>
            </div>
                  
        </div>                           
        <!--formgroup end-->

        <div class="form-group">
            <h3>What do you need an expert for<span class="star">*</span></h3>  
 
            <div class="radio">
                <label>
                <input type="radio" name="needan_expertfor"value="Manage ongoing campaigns (and/or) accounts based on existing strategies" required>
                Manage ongoing campaigns (and/or) accounts based on existing strategies

                </label>
            </div>                           
            <div class="radio">
                <label>

                <input type="radio" name="needan_expertfor"value="Analyze current setup and suggest improvements (CPO reduction, growth">
                Analyze current setup and suggest improvements (CPO reduction, growth

                </label>
            </div>
            <div class="radio">
                <label>
                <input type="radio" name="needan_expertfor"value="Professional Services">
                Professional Services
                </label>
            </div>                           
            <div class="radio">
                <label>
                <input type="radio" name="needan_expertfor"value="Set up account from scratch and launch performance marketing campaigns">
                Set up account from scratch and launch performance marketing campaigns
                </label>
            </div> 
            <div class="radio">
                <label>
                <input type="radio" name="needan_expertfor"value="Analyze and improve technical configuration (i.e. tech SEO, pixel implementation…)">
                Analyze and improve technical configuration (i.e. tech SEO, pixel implementation…)
                </label>
            </div>

            <div class="radio">
                <label>
                <input type="radio" name="needan_expertfor"value="Prepare current accounts for large scale and/or geo expansion">
                Prepare current accounts for large scale and/or geo expansion
                </label>
            </div>             

            <div class="radio">
                <label>
                <input type="radio" name="needan_expertfor"value="Interim management (i.e. team member resigned and you don’t have replacement)">
                Interim management (i.e. team member resigned and you don’t have replacement)
                </label>
            </div>             

            <div class="radio">
                <label>
                <input type="radio" name="needan_expertfor"value="Other">
                Other
                </label>
            </div> 
                  
        </div>

        <!--form group end-->
        <div class="form-group">
            <h3>What level of engagement you require<span class="star">*</span></h3>  
 
            <div class="radio">
                <label>
                <input type="radio" name="engagement"value="40+ hrs a week (full-time)" required>
                40+ hrs a week (full-time)

                </label>
            </div>                           
            <div class="radio">
                <label>

                <input type="radio" name="engagement"value="10-20 hrs a week">
                10-20 hrs a week

                </label>
            </div>

            <div class="radio">
                <label>
                <input type="radio" name="engagement"value="5-10 hrs a week">
                5-10 hrs a week
                </label>
            </div>                           
            <div class="radio">
                <label>
                <input type="radio" name="engagement"value="Less than 5 hrs a week">
                Less than 5 hrs a week
                </label>
            </div> 
            <div class="radio">
                <label>
                <input type="radio" name="engagement"value="One off consultation">
                One off consultation
                </label>
            </div>

                  
        </div>                                
        <!--form group end-->                        
 
        <!--fields start-->
        <div class="form-group">
            <label>Name<span class="star">*</span></label>
            <input class="form-control" name="name" required></input>
        </div>                        
        <div class="form-group">
            <label>Company Name<span class="star">*</span></label>
            <input class="form-control" name="company_name" required></input>
        </div>                        
        <div class="form-group">
            <label>Company Website</label>
            <input class="form-control" name="company_website"></input>
        </div>                        
        <div class="form-group">
            <label>Corporate Email<span class="star">*</span></label>
            <input type="email" class="form-control" name="email" required></input>
        </div>        
        <div class="form-group">
            <label>Password<span class="star">*</span></label>
            <input type="password" class="form-control" name="password" required></input>
        </div>
                        
        <!--fields end-->
                        
    </div>
            ';
            break;            

            case "digital_marketer":
                echo 
                '
    <div id="digital_marketer">
        <div class="form-group">
            <h3>Would like to hire<span class="star">*</span></h3>   
            <div class="radio">
                <label>
                <input type="radio" name="hire"value="Paid Social (FB ads, Instagram ads, Snapchat ads)" required>
                Paid Social (FB ads, Instagram ads, Snapchat ads)

                </label>
            </div>                           
            <div class="radio">
                <label>
                <input type="radio" name="hire"value="PPC (google adword)">
                PPC (google adword)

                </label>
            </div>                           
            <div class="radio">
                <label>
                <input type="radio" name="hire"value="SEO and ASO">
                SEO and ASO
                </label>
            </div>                           
            <div class="radio">
                <label>
                <input type="radio" name="hire"value="Web analytics (GA)">
                Web analytics (GA)
                </label>
            </div> 

            <div class="radio">
                <label>
                <input type="radio" name="hire"value="Mobile analytics (Adjsut, Appsflyer)">
                Mobile analytics (Adjsut, Appsflyer)
                </label>
            </div>
            <div class="radio">
                <label>
                <input type="radio" name="hire"value="BI  and data science (PowerBI, SQL, Python)">
                BI  and data science (PowerBI, SQL, Python)
                </label>
            </div>              

            <div class="radio">
                <label>
                <input type="radio" name="hire"value="UI/UX">
                UI/UX
                </label>
            </div>              

            <div class="radio">
                <label>
                <input type="radio" name="hire"value="Graphic Design and animation">
                Graphic Design and animation
                </label>
            </div>              

            <div class="radio">
                <label>
                <input type="radio" name="hire"value="Mobile Product Marketing">
                Mobile Product Marketing
                </label>
            </div>              

            <div class="radio">
                <label>
                <input type="radio" name="hire"value="Interim CMO/CDO">
                Interim CMO/CDO
                </label>
            </div>             

            <div class="radio">
                <label>
                <input type="radio" name="hire"value="CRO">
                CRO
                </label>
            </div>                   
        </div>
        <!--formgroup end-->
        <div class="form-group">
            <label>Add Job Desciption<span class="star">*</span></label>
            <textarea class="form-control" name="job_desc" required></textarea>
        </div>
        <!--fields start-->
        <div class="form-group">
            <label>Name<span class="star">*</span></label>
            <input class="form-control" name="name" required></input>
        </div>                        
        <div class="form-group">
            <label>Company Name<span class="star">*</span></label>
            <input class="form-control" name="company_name" required></input>
        </div>                        
        <div class="form-group">
            <label>Company Website</label>
            <input class="form-control" name="company_website"></input>
        </div>                        
        <div class="form-group">
            <label>Corporate Email<span class="star">*</span></label>
            <input type="email" class="form-control" name="email" required></input>
        </div>        
        <div class="form-group">
            <label>Password<span class="star">*</span></label>
            <input type="password" class="form-control" name="password" required></input>
        </div>
                        
        <!--fields end-->
                        
    </div>
                ';
            break;            

            case "digital_audit":
            echo 
            '
    <div id="digital_audit">
        <!--formgroup end-->
        <div class="form-group">
            <h3>Your company focus<span class="star">*</span></h3>   
            <div class="radio">
            <label>
            <input type="radio" name="company_focus"value="D2C" required>
            D2C

            </label>
        </div>                           
        <div class="radio">
            <label>
            <input type="radio" name="company_focus"value="B2C">
            B2C

            </label>
        </div>                           
        <div class="radio">
            <label>
            <input type="radio" name="company_focus"value="B2B">
            B2B
            </label>
        </div>                           
        <div class="radio">
            <label>
            <input type="radio" name="company_focus"value="Fintech">
            Fintech
            </label>
        </div> 

        <div class="radio">
            <label>
            <input type="radio" name="company_focus"value="SaaS">
            SaaS
            </label>
        </div>
        <div class="radio">
            <label>
            <input type="radio" name="company_focus"value="Other">
            Other
            </label>
        </div>                   
    </div>
        <!--formgroup end-->
        <div class="form-group">
            <h3>Your company niche<span class="star">*</span></h3>  
 
            <div class="radio">
                <label>
                <input type="radio" name="company_niche"value="Ecommerce" required>
                Ecommerce

                </label>
            </div>                           
            <div class="radio">
                <label>

                <input type="radio" name="company_niche"value="Transportation and delivery">
                Transportation and delivery

                </label>
            </div>
            <div class="radio">
                <label>
                <input type="radio" name="company_niche"value="Professional Services">
                Professional Services
                </label>
            </div>                           
            <div class="radio">
                <label>
                <input type="radio" name="company_niche"value="Service marketplace">
                Service marketplace
                </label>
            </div> 
            <div class="radio">
                <label>
                <input type="radio" name="company_niche"value="Hospitality">
                Hospitality
                </label>
            </div> 

            <div class="radio">
                <label>
                <input type="radio" name="company_niche"value="SaaS">
                SaaS
                </label>
            </div>
            <div class="radio">
                <label>
                <input type="radio" name="company_niche"value="Other">
                Other
                </label>
            </div>                   
                        <!--formgroup end-->
        </div>
        <!--formgroup end-->
        <div class="form-group">
            <h3>Your product/service<span class="star">*</span></h3>  
 
            <div class="radio">
                <label>
                <input type="radio" name="product_service"value="Must have daily (uber)" required>
                Must have daily (uber)

                </label>
            </div>                           
            <div class="radio">
                <label>

                <input type="radio" name="product_service"value="Must have weekly/monthly (amazon, hellofresh)">
                Must have weekly/monthly (amazon, hellofresh)

                </label>
            </div>
            <div class="radio">
                <label>
                <input type="radio" name="product_service"value="Professional Services">
                Professional Services
                </label>
            </div>                           
            <div class="radio">
                <label>
                <input type="radio" name="product_service"value="Special occasion or luxury (rent-a-runaway)">
                Special occasion or luxury (rent-a-runaway)
                </label>
            </div> 
            <div class="radio">
                <label>
                <input type="radio" name="product_service"value="Nice have (booking.com)">
                Nice have (booking.com)
                </label>
            </div>                           
            <div class="radio">
                <label>
                <input type="radio" name="product_service"value="Other">
                Other
                </label>
            </div> 
                  
        </div>  
        <!--form group end-->                      
        <div class="form-group">
            <h3>Your goals are<span class="star">*</span></h3>  
 
            <div class="radio">
                <label>
                <input type="radio" name="goals"value="Going online" required>
                Going online
                </label>
            </div>                           
            <div class="radio">
                <label>

                <input type="radio" name="goals"value="Better understand user behaviour and/or Improve user experience">
                Better understand user behaviour and/or Improve user experience
                </label>
                </div>
            <div class="radio">
                <label>
                <input type="radio" name="goals"value="Set up or Improve performance marketing">
                Set up or Improve performance marketing
                </label>
            </div>                           
            <div class="radio">
                <label>
                <input type="radio" name="goals"value="Improve digital strategy">
                Improve digital strategy
                </label>
            </div> 
            <div class="radio">
                <label>
                <input type="radio" name="goals"value="Set up digital team">
                Set up digital team
                </label>
            </div>            

            <div class="radio">
                <label>
                <input type="radio" name="goals"value="Technology implementation (CRM, tracking, BI etc etc)">
                Technology implementation (CRM, tracking, BI etc etc)
                </label>
            </div>            

            <div class="radio">
                <label>
                <input type="radio" name="goals"value="Train in-house team">
                Train in-house team
                </label>
            </div>
                  
        </div>                           
        <!--formgroup end-->
        <!--fields start-->
        <div class="form-group">
            <label>Name<span class="star">*</span></label>
            <input class="form-control" name="name" required></input>
        </div>                        
        <div class="form-group">
            <label>Company Name<span class="star">*</span></label>
            <input class="form-control" name="company_name" required></input>
        </div>                        
        <div class="form-group">
            <label>Company Website</label>
            <input class="form-control" name="company_website"></input>
        </div>                        
        <div class="form-group">
            <label>Corporate Email<span class="star">*</span></label>
            <input type="email" class="form-control" name="email" required></input>
        </div>        
        <div class="form-group">
            <label>Password<span class="star">*</span></label>
            <input type="password" class="form-control" name="password" required></input>
        </div>
                        
        <!--fields end-->
                        
    </div>
            ';
            break;            

            case "onoff":
            echo 
            '
                <div id="onoff_pack">

        <!--fields start-->
        <div class="form-group">
            <h3>What we do for you?<span class="star">*</span></h3>
            <div calss="radio">
            <label>
                <input type="radio" name="pack_id" value="1"  required>
                Web Analytics and User Experience Audit
                <div class="packages">
                    $299 <br>
                    Analytics and tracking audit<br>
                    UI/UX analysis based on current tracking, analytics and interface and global best practices.
                </div>
            </label> 
            </div>           

            <div calss="radio">
            <label>
                <input type="radio" name="pack_id" value="2">
                Facebook Ads Audit
                <div class="packages">
                    $199 <br>
                    Account health check<br>
                    Facebook ads strategy audit
                </div>
            </label> 
            </div>            

            <div calss="radio">
            <label>
                <input type="radio" name="pack_id" value="3">
                Google Ads Audit
                <div class="packages">
                    $199 <br>
                    Account health check<br>
                    Google ads strategy audit
                </div>
            </label> 
            </div> 
            <div calss="radio">
            <label>
                <input type="radio" name="pack_id" value="4">
                Interview
                <div class="packages">
                    $99 <br>
                    Get the candidate interviewed by a top expert in the field
                </div>
            </label> 
            </div> 
            <div calss="radio">
            <label>
                <input type="radio" name="pack_id" value="5">
                Mobile App Audit
                <div class="packages">
                    $499 <br>
                    Tracking concept analysis<br>
                    User acquisition strategy audit

                </div>
            </label> 
            </div> 
            <div calss="radio">
            <label>
                <input type="radio" name="pack_id" value="6">
                SEO Audit
                <div class="packages">
                    $199 <br>
                    On-page SEO analysis<br>
                    
                </div>
            </label> 
            </div>                         

        </div>
        <!--formgroup end-->
        <div class="form-group">
            <label>Name<span class="star">*</span></label>
            <input class="form-control" name="name" required></input>
        </div>                        
        <div class="form-group">
            <label>Company Name<span class="star">*</span></label>
            <input class="form-control" name="company_name" required></input>
        </div>                        
        <div class="form-group">
            <label>Company Website</label>
            <input class="form-control" name="company_website"></input>
        </div>                        
        <div class="form-group">
            <label>Corporate Email<span class="star">*</span></label>
            <input type="email" class="form-control" name="email" required></input>
        </div>        
        <div class="form-group">
            <label>Password<span class="star">*</span></label>
            <input type="password" class="form-control" name="password" required></input>
        </div>
                        
        <!--fields end-->
                        
    </div>
            ';
            break;

            default:
                # code...
                break;
        }
    }
}
