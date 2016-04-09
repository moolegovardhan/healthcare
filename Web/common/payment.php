<div class="col-md-15">
    <br/>
    <fieldset>
        <div class="row">
            <section class="col-md-4">
                <label class="select">
                    <select id="paymenttype" class="form-control"  >
                        <option value="selectpaymenttype">-- Select Payment Type --</option>
                        <option value="cash">Cash</option>
                        <option value="creditcard">Credit Card</option>
                        <option value="debitcard">Debit Card</option>
                        <option value="wallet">Wallet</option>
                        <option value="voucher">Voucher</option>
                     </select>
                  </label>
            </section>
            <section class="col-md-4">
                <label class="input">
                    <i class="icon-append fa fa-money"></i>
                    <input type="text" id="paidamount" name="paidamount" placeholder="Amount Paid" onblur="updatepaidamount()">
                </label>
            </section>
                  <section class="col-md-3"  id="printbutton">
                    <button class="btn-u btn-u-orange pull-right" onclick="myFunction()" type="button" value="button"><i class="fa fa-print"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Print&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   </button>

              </section>
      </div>
        
    </fieldset>
    <br/>
      <!-- Tab v3 -->                
    <div class="row tab-v3">
        <div class="col-sm-3">
            <ul class="nav nav-pills nav-stacked"> 
                <li class="active"><a href="#home-2" data-toggle="tab"><i class="fa fa-home"></i> Credit Card</a></li>
                <li><a href="#profile-2" data-toggle="tab"><i class="fa fa-cloud"></i> Debit Card</a></li>
                <li><a href="#messages-2" data-toggle="tab"><i class="fa fa-comments"></i> Wallet</a></li>
                <li><a href="#settings-2" data-toggle="tab"><i class="fa fa-gear"></i> Voucher</a></li>                        
            </ul>                    
        </div>
        <div class="col-sm-9">
            <div class="tab-content">
                <div class="tab-pane fade in active" id="home-2">
                    <h5>Credit Card </h5>
                    <fieldset>
                        <section>
                            <label class="select">
                                <select id="cardtype" >
                                    <option value="cardtype">-- Select Card Type --</option>
                                    <option value="visa">Visa</option>
                                    <option value="mastercard">Master Card</option>
                                    <option value="rupay">Rupay</option>
                                 </select>
                              </label>
                        </section>
                        <section>
                            <label class="input">
                                <i class="icon-append fa fa-credit-card"></i>
                              <input type="text" id="creditcardnumber" name="creditcardnumber" placeholder="Card Number">
                            </label>
                           
                        </section>
                          <section>
                            <label class="input">
                                <i class="icon-append fa fa-user"></i>
                              <input type="text" id="creditcardname" name="creditcardname" placeholder="Name on Card">
                            </label>
                           
                        </section>
                        <section class="col-md-4">
                            <label class="input">
                                 <i class="icon-append fa fa-credit-card"></i>
                              <input type="text" id="cvv" name="cvv" placeholder="CVV" >
                            </label>
                           
                        </section>
                        
                    </fieldset>    
                </div>
                <div class="tab-pane fade in" id="profile-2">
                                   
                    <h5>Debit Card</h5>
                       <fieldset>
                           <section >
                            <label class="select">
                                <select id="cardtype" class="form-control"  >
                                    <option value="cardtype">-- Select Card Type --</option>
                                    <option value="visa">Visa</option>
                                    <option value="mastercard">Master Card</option>
                                    <option value="rupay">Rupay</option>
                                 </select>
                              </label>
                        </section>
                        <section>
                            <label class="input">
                                 <i class="icon-append fa fa-credit-card"></i>
                              <input type="text" id="debitcardnumber" name="debitcardnumber" placeholder="Debit Card Number">
                            </label>
                           
                        </section>
                       
                           <section>
                            <label class="input">
                                 <i class="icon-append fa fa-user"></i>
                              <input type="text" id="debitcardname" name="debitcardname" placeholder="Name on Card">
                            </label>
                           
                        </section>
                        <section class="col-md-4">
                            <label class="input">
                                  <i class="icon-append fa fa-credit-card"></i>
                              <input type="text" id="cvv" name="cvv" placeholder="CVV">
                            </label>
                           
                        </section>
                    </fieldset>  
                
                
                </div>
                <div class="tab-pane fade in" id="messages-2">
                    <h5>Wallet </h5>
                    <fieldset>
                         <section>
                            <label class="input">
                                <input type="text" id="wallet" name="wallet" placeholder="Wallet" value="<?php echo $data[0]->totalamount ?>" readonly="true">
                            </label>
                           
                        </section>
                    </fieldset>    
                </div>
                <div class="tab-pane fade in" id="settings-2">
                                          
                    <h4>Voucher</h4>
                    <fieldset>
                         <section>
                            <label class="input">
                              <input type="text" id="voucher" name="voucher" placeholder="Voucher" readonly="true">
                            </label>
                           
                        </section>
                    </fieldset>    
                </div>
            </div>                                    
        </div>
    </div>            
    <!-- Tab v3 --> 
    
    
</div>