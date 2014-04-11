<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<form name="frmvoucher" id="frmvoucher" action="<?php echo $current_url;?>" method="POST" data-abide>

	<h3>Add Account Voucher</h3>

	<div class="row">
		<div class="large-4 columns">
		<?php echo $ledger->error_description;?>
		</div>
	</div>


	
	<div class="row">

	 	<div class="medium-8 columns" >
	 	<fieldset>
	 		<legend>Voucher Elements </legend>
 			<div class="medium-6 columns">
				<label for="ledger">Name<small>requied</small>
				<input type="text" name="txtname" id="txtname" value="" required/>
				</label>

				<label for="ledger">Type<small>requied</small>
				<?php echo populate_list_array("lstmvoucher", $masterVouchers, 'id','name', '',$disable=false);?>
				</label>
			
				
			</div>
			<div class="medium-6 columns">
				<label for="ledger">Description</label>
				<textarea name="txtdescription"></textarea>
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
	 				<textarea class="ckeditor" name="txtheader"></textarea>
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
	 		<legend>Account / Module Settings</legend>
	 		<div class="row">
		 		<div class="medium-4 columns" >
		 			<div class="row">
		 				<div class="medium-12 columns" >
		 					<input type="checkbox" name="chk_hidden" id="chk_hidden"/> Voucher For Module
		 				</div>
		 			</div>
		 			<div class="row" id="dv-modules" >
		 				<div class="medium-12 columns" >
		 					<label for="ledger">Module</label>
		 					<?php echo populate_list_array("lstmodules", $g_ARRAY_LIST_MODULE, 'id','name', '',$disable=false,true);?>
		 				</div>
		 			</div>
		 		</div>
		 		<div class="medium-4 columns" >
		 			<div class="row">
		 				<input type="checkbox" name="chk_currency" id="chk_currency" value=1 checked /> Default Currency 
		 			(<?php echo $currency->default_currency_symbol;?>)
		 			</div>
		 			<div class="row" id="div_cnr">
		 				<label for="ledger">Currency</label>
		 				<?php echo populate_list_array("lstcurrency", $currencies, 'id','symbol', '',$disable=false,true);?>
		 			</div>
		 		</div>
		 	</div>

		 	<p></p>

		 	<div class="row">
		 		<input type="hidden" name="hd_ac_dest" id="hd_ac_dest" value="-1" />
		 		<div class="medium-4 columns" id="dv-dflt-from" >
					<label for="ledger">Default From Account</label>
					<?php echo populate_multiple_list_array("lstfromledger", $ledgers, 'id','name', array(),$disable=false,false);?>
				</div>

				<div class="medium-4 columns" id="dv-dflt-to">
					<label for="ledger">Default To Account</label>
					<?php echo populate_multiple_list_array("lsttoledger", $ledgers, 'id','name',  array(),$disable=false,false);?>
				</div>
			</div>

	 	</fieldset>
		</div>
	</div>

	<p></p>

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
 		

