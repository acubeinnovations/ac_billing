<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<form name="frmvoucher" id="frmvoucher" action="<?php echo $current_url;?>" method="POST" data-abide>

<h3>Add Voucher</h3>

<div class="row">
	<div class="large-4 columns">
	<?php echo $ledger->error_description;?>
	</div>
</div>


	
 <div class="row">

 		<div class="medium-8 columns" >
 		<fieldset>
 			<legend>masterVouchers Elements </legend>
 			<div class="row">
 				<div class="medium-7 columns">
					<label for="ledger">Name<small>requied</small>
					<input type="text" name="txtname" id="txtname" value="" required/>
					</label>
				</div>	
				<div class="medium-5 columns">
					<label for="ledger">Type<small>requied</small>
					<?php echo populate_list_array("lstmvoucher", $masterVouchers, 'id','name', '',$disable=false);?>
					</label>
				</div>
 			
				<div class="medium-7 columns">
					<label for="ledger">Description
					<textarea name="txtdescription" id="txtdescription"></textarea>
					</label>
				</div>

				<div class="medium-5 columns" id="src_items" >
					<label for="ledger">Customer/Supplier
					<?php echo populate_list_array("lstsourceitem", $voucher_source_item_list, 'id','name', '',$disable=false);?>
					<input type="hidden" value="-1" name="hd_ac_to" id="hd_ac_to" />
					</label>
				</div>

			</div>
			
		</fieldset>	
 		</div>


 		

 		<div class="medium-4 columns">
 		<fieldset>
 			<legend>Number Series </legend>
 				<div class="row">
	 				<div class="medium-4 columns">
						<label for="ledger"> Prefix</label>
						<input type="text" name="txtprefix" id="txtprefix" value=""/>
					</div>
					<div class="medium-4 columns">
						<label for="ledger">Suffix</label>
						<input type="text" name="txtsufix" id="txtsufix" value=""/>
					</div>
					<div class="medium-4 columns">
						<label for="ledger">Seperator</label>
						<select name="lstseperator">
							<option value="">None</option>
							<option value="_">_</option>
							<option value="-">-</option>
							<option value=".">.</option>
							<option value=":">:</option>
							
						</select>
					</div>
				</div>
				<div class="row">
					<div class="columns">
						<label for="ledger">Start From<small>required</small>
						<input type="text" name="txtseries" id="txtseries" value="" required/>
						</label>
					</div>
				</div>

				
			</fieldset>
 		</div>


</div>			
 		
<div class="row">
<div class="medium-12 columns" >
	<fieldset>
 		<legend>Form Elements</legend>
 		
 		<div class="row">
 			<div class="medium-6 columns" >	
 				<label for="ledger">Header</label>
 				<input type="checkbox" name="chk_header" id="chk_header" value=1 /> Use Default
 				<textarea class="ckeditor" name="txtheader" id="txtheader"></textarea>
 			</div>
 		
 			<div class="medium-6 columns">	
 				<label for="ledger">Footer</label>
 				<input type="checkbox" name="chk_footer" id="chk_footer" value=1 /> Use Default
 				<textarea class="ckeditor" name="txtfooter"></textarea>
 			</div>
 		</div>

 	</fieldset>
 	</div>
</div>

<div class="row" >
<div class="medium-12 columns">	
	<fieldset>
 		<legend>Voucher Settings</legend>

 		<div class="medium-3 columns" >
 			<input type="checkbox" name="chk_hidden" id="chk_hidden"/> Voucher For Module
 		</div>

 		<div class="medium-3 columns" >
 			<input type="checkbox" name="chk_currency" id="chk_currency" value=1 checked /> Default Currency 
 			(<?php echo $currency->default_currency_symbol;?>)
 		</div>

 		<div class="medium-3 columns" id="div_cnr" >
 			<label for="ledger">Currency</label>
 			<?php echo populate_list_array("lstcurrency", $currencies, 'id','symbol', '',$disable=false,true);?>
 		</div>


 		<div class="medium-12 columns" style="display:none;" id="div-settings">

 		<div class="medium-4 columns" >
 			<label for="ledger">Module</label>
 			<?php echo populate_list_array("lstmodules", $g_ARRAY_LIST_MODULE, 'id','name', '',$disable=false,true);?>
 		</div>
 		<div class="medium-4 columns" >
 			<label for="ledger">Account From</label>
 			<?php echo populate_list_array("lstfromledger", $ledgers, 'id','name', '',$disable=false,true);?>
 		</div>
 		<div class="medium-4 columns" >
 			<label for="ledger">Account To</label>
 			<?php echo populate_list_array("lsttoledger", $ledgers, 'id','name', '',$disable=false,true);?>
 		</div>
 		</div>

 	</fieldset>
</div>
</div>


<div class="row" id="v_ac_dtls" >
<div class="medium-12 columns">	
	<fieldset>
 		<legend>Voucher account Details</legend>

 		<div class="medium-4 columns" >
 			<label for="ledger">Source<small id="error_source">required</small>
 			<select name="lstsource" id="lstsource">
 				<option value="-1">Choose from list..</option>
 				<option value="1">Voucher for account</option>
 				<option value="2">Voucher for inventory</option>
 			</select>
 			</label>
 		</div>

 		<div class="medium-8 columns" id="div-dtls1">
 			<div class="medium-6 columns" >
	 			<label for="ledger">Default Account</label>
	 			<select name="lstaccount" id="lstsource">
	 				<option value="<?php echo FROM; ?>">From</option>
	 				<option value="<?php echo TO; ?>">To</option>
	 			</select>
 			</div>
 			<div class="medium-6 columns" >
				<label for="ledger">Ledgers</label>
 				<?php echo populate_multiple_list_array("lstledger", $ledgers, 'id','name', array(),$disable=false,false);?>
 			</div>
 		</div>

 		<div class="medium-8 columns" id="div-dtls2">
 			<div class="row">
	 			<div class="medium-4 columns" >
		 			<label for="ledger">Default From Account</label>
		 			<?php echo populate_multiple_list_array("lstfromledger", $ledgers, 'id','name', array(),$disable=false,false);?>
	 			</div>
	 			<div class="medium-4 columns" id="src2_dft_to">
					<label for="ledger">Default To Account</label>
	 				<?php echo populate_multiple_list_array("lsttoledger", $ledgers, 'id','name',  array(),$disable=false,false);?>
	 			</div>

	 			<div class="medium-4 columns" >
					<label for="ledger">Form Type</label>
	 				<?php echo populate_list_array("lstformtype", $form_types, 'id','value', '',$disable=false);?>
	 				<label for="ledger" >No Of Copies (Prints)
	 				<?php echo populate_list_array("lstcopy", $g_ARRAY_LIST_COPY, 'id','value', '',$disable=false,false,"style='width:50px;'");?>
	 				</label>
	 			</div>
 			</div>

 			<div class="row">
	 			<div class="medium-5 columns" >
	 				<input type="checkbox" name="chk_drc" id="chk_drc" value=1 />
		 			<label for="ledger">Discount Received(Amount)</label>
	 			</div>
	 			<div class="medium-4 columns" >
	 				<input type="checkbox" name="chk_fad" id="chk_fad" value=1 />
		 			<label for="ledger">Freight and Demurge</label>
	 			</div>

	 			<div class="medium-3 columns" >
	 				<input type="checkbox" name="chk_drc" id="chk_drc" value=1 />
		 			<label for="ledger">Round Off</label>
	 			</div>
 			</div>

 		</div>

 		
	
 		
	</fieldset>	
</div>
</div>

<div class="row">
	<div class="text-center">
		<input class="tiny button"  value="Save" name="submit" type="submit"/>
	</div>
</div>

</form>







<!--default contents-->
<div id="default_header_content">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" >
		<tbody>
			<tr>
				<td style="height:25px; width:322px">
					<p>Tax payers Identification No : <?php echo $account_settings->tax_payers_id_no;?></p>
				</td>
				<td style="height:25px; width:322px">
					<p style="text-align:right">Central Sales Tax Reg.No.: <?php echo $account_settings->central_sales_tax_reg_no;?></p>
				</td>
			</tr>
			<tr>
				<td style="height:25px; width:322px">
					<p>CENTRAL EXCISE REGN.No :<?php echo $account_settings->central_exise_reg_no;?></p>
				</td>
				<td style="height:25px; width:322px">
					<p>&nbsp;</p>
				</td>
			</tr>
			<tr>
				<td style="height:25px; width:322px">
					<p>SSI / MSI / LSI Regn.No.: <?php echo $account_settings->reg_no;?></p>
				</td>
				<td style="height:25px; width:322px">
					<p>&nbsp;</p>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="height:139px; width:645px">
					<p style="text-align:center"><span style="font-size:16px">
					<strong><?php echo $account_settings->organization_name;?>.</strong></span><br />
					<?php echo $account_settings->organization_address;?><br />
					THE KERALA VALUE ADDED TAX RULES, 2005<br />
					<br />
					<strong><span style="font-size:16px">FORM NO. $$form$$</span></strong><br />
					[See rule 58(10)]</p>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="height:71px; width:645px">
					<p style="text-align:center"><span style="font-size:16px"><strong>TAX INVOICE</strong></span><br />
					CASH / CREDIT<br />
					(To be Prepared in Quadruplicate*)</p>
				</td>
			</tr>
			<tr>
				<td style="height:23px; width:322px">
					<p><strong>Invoice No.: $$voucher_number$$</strong></p>
				</td>
				<td style="height:23px; width:322px">
					<p style="text-align:right"><strong>Date :$$today$$ </strong></p>
				</td>
			</tr>
			<tr>
				<td style="height:23px; width:322px">
					<p><strong>Purchase order No.&amp; Date : $$ref_number$$</strong></p>
				</td>
				<td style="height:23px; width:322px">
					<p style="text-align:right">&nbsp;</p>
				</td>
			</tr>
			<tr>
				<td style="height:71px; width:322px">
					<p><strong>Name &amp; Address of Purchasing Dealer :</strong></p>

					<p>$$name$$ , <br />$$address$$</p>
					</td>
					<td style="height:71px; width:322px">
					<p style="text-align:right">&nbsp;</p>
					</td>
					</tr>
					<tr>
					<td style="height:23px; width:322px">
					<p>TIN : $$tin$$</p>
					</td>
					<td style="height:23px; width:322px">
					<p style="text-align:right">Central Sales Tax Reg.No.: $$cst$$</p>
				</td>
			</tr>
		</tbody>
	</table>					

</div>


<div id="default_footer_content">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" dir="ltr">
		<tbody>
		<tr>
			<td colspan="3"><strong>E&amp;OE</strong></td>
		</tr>
		<tr>
			<td rowspan="1" colspan="3">Terms of Delivery and payment if any :</td>
		</tr>
		<tr>
			<td colspan="3"><strong>DECLARATION</strong></td>
		</tr>
		<tr>
			<td rowspan="1" colspan="3">Certified that all the particulars shown in the above Tax Invoice are true and correct and that my/ourRegistration under KVAT Act 2003 is valid as on the date of this Bill.</td>
		</tr>
		<tr>
			<td width="524"></td>
			<td width="491" colspan="2" rowspan="1" align="right">Authorised Signatory</td>
		</tr>
		<tr>
			<td height="39"></td>
			<td colspan="2" rowspan="1" align="right" valign="bottom">[With Status &amp; Seal]</td>
		</tr>
		<tr>
			<td rowspan="1" colspan="3">* Original Duplicate for the Transport Copy,Triplicate for filing at the Check Post / Extra Copy &amp; Quadruplicate to be retained with the seller.</td>
		</tr>
		</tbody>
	</table>					
</div>
 		

