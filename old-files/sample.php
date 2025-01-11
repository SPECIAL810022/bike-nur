<% function mydate(){ var today=new Date(); var yyyy=today.getFullYear(); var mm=today.getMonth()+1; var
    dd=today.getDate(); var hr=today.getHours(); var mins=today.getMinutes(); return dd+"/"+mm+"/"+yyyy+" "+hr+"
    :"+mins; } function convertNumberToWords(num) { console.log("number in conversion "+num);
    var ones = ["", " One ", " Two ", " Three ", " Four ", " Five ", " Six ", " Seven ", " Eight ", " Nine ", "
    Ten ", " Eleven ", " Twelve ", " Thirteen ", " Fourteen ", " Fifteen ", " Sixteen ", " Seventeen ", " Eighteen ", "
    Nineteen "];
    var tens = ["", "", " Twenty", "Thirty" , "Forty" , "Fifty" , "Sixty" , "Seventy" , "Eighty" , "Ninety" ]; if
    ((num=num.toString()).length> 9) return "Overflow: Maximum 9 digits supported";
    var n = ("000000000" + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
    if (!n) return;
    var str = "";
    str += n[1] != 0 ? (ones[Number(n[1])] || tens[n[1][0]] + " " + ones[n[1][1]]) + "Crore " : "";
    str += n[2] != 0 ? (ones[Number(n[2])] || tens[n[2][0]] + " " + ones[n[2][1]]) + "Lakh " : "";
    str += n[3] != 0 ? (ones[Number(n[3])] || tens[n[3][0]] + " " + ones[n[3][1]]) + "Thousand " : "";
    str += n[4] != 0 ? (ones[Number(n[4])] || tens[n[4][0]] + " " + ones[n[4][1]]) + "Hundred " : "";
    str += n[5] != 0 ? (str != "" ? "and " : "") + (ones[Number(n[5])] || tens[n[5][0]] + " " + ones[n[5][1]]) : "";
    console.log("Converted number "+str);
    return str;
    }
    var serial = 1;
    var serial_two = 1;

    %>
<div class="invoice-details">
    <img src="http://mobitalk.deltaminds.com/wp-content/uploads/2024/05/ORIGINAL-FOR-BUYERS-2.png" width="100%" />
</div>

<hr />
<DIV>

    <div class="customer-info" STYLE="FLOAT:left;MARGIN:15PX">
        <h2>CUSTOMER INFORMATION</h2>
        <p>NAME: <%= customer.name %>
        </p>
        <p>ADDRESS:<%= customer.address %>
        </p>
        <p>
            <%= customer.city %> PIN:<%= customer.postcode %>
        </p>
        <P>STATE: <%= customer.state %>
        </P>
        <p>PHONE: <%= customer.phone %>
        </p>
        <h3>CUSTOMER GST: <%= customer.address_2 %>
        </h3>

    </div>

    <div class="customer-info" style="float:right;margin:20px">
        INVOICE NO:<%= order_number_format %><br />
        DATE: <%= created_at %>
    </div>


</DIV>
<div class="item-details">
    <table>
        <thead>
            <tr>
                <th>Sl</th>
                <th>Description</th>
                <th>HSN Code</th>
                <th>Quantity</th>
                <th>Rate</th>
                <th>Ammount</th>
            </tr>
        </thead>
        <tbody>
            <% items.forEach(function(item){ %>
            <tr>
                <td>
                    <%= serial++ %>
                </td>
                <td>
                    <%=item.name%>
                    <p>IMEI1:<%=item.product.sku%>
                    </p>

                </td>

                <td>85171300</td>
                <td>
                    <%=item.qty%>
                </td>
                <td>
                    <%=item.total_currency_formatted %> %>
                </td>
                <td>
                    <%= (parseFloat(item.total_currency_formatted) * 1.18).toFixed(2) %>
                </td>


            </tr>
            <% }); %>

            <% tax_details.forEach(function(tax){ %>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>CGST(9%):</td>
                <td>
                    <%= tax.total/2 %>
                </td>
            </tr>


            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>SGST(9%):</td>
                <td>
                    <%= tax.total/2 %>
                </td>
            </tr>
            <% }); %>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><strong>GRAND TOTAL:</strong></td>
                <td><strong>
                        <%= grand_total_currency_formatted %>
                    </strong></td>
            </tr>
            <tr>
                <td><STRONG>PAYMENT METHODS</STRONG></td>
                <td colspan=5>
                    <% payment_method.forEach(function(payment){ %>
                    <%= payment.name %> : <%= payment.paid_currency_formatted %>
                    <% }) %>
                </td>
            </tr>

            <tr>
                <td COLSPAN=6><STRONG>FINANCE DETAILS</STRONG></td>
            </tr>

            <tr>
                <td COLSPAN=6>FINANCE BY: <%=addition_information.provider %>, DP:
                    <%=addition_information.dp %>,MONTHLY PAYMENT:
                    <%=addition_information.ma %>
                </td>
            </tr>

            <tr>

                <td colspan=6>Amount in words: </td>
            </tr>

            <tr>
                <td colspan=4>
                    <UL>
                        <LI>মোবাইল ফোনের 1 year warranty. Headphone / Charger /Battery 6 month
                            warranty </LI>
                        <LI>মোবাইল ফোনের সার্ভিসের জন্য CUSTOMER কে নিজেকে SERVICE CENTER যেতে হবে.
                            আমরা কোনো দ্বায়িত্ব নেবো না </LI>
                        <LI>বিল হারিয়ে গেলে কোনো প্রকার পরিষেবা পাওয়া যাবে না </li>
                        <li>মোবাইল বিল হয়ে যাবার পর ফেরত/বদল হয় না </LI>
                        <li>Goods once sold cannot be taken back</li>
                        <li>Tax paid at source</li>
                        <li>All goods carry the manufacturers' warranty</li>
                        <li>No exchange, No refund after the bill is done</li>
                        <li>The transaction of this bill is subject to Chandannagar Jurisdiction
                        </li>
                        <li>
                            <h4>Goods received in good condition and sealed pack</h4>
                        </li>
                    </UL>
                    <p style="margin-top:20px">Customer Signature</p>
                    <p style="margin-top:20px">Date:</p>
                </td>
                <td colspan=2>
                    <img src="http://mobitalk.deltaminds.com/wp-content/uploads/2024/05/20240508_130439-Photoroom.png-Photoroom.png" alt="" width="150px" height="80px">
                </td>
            </tr>
        </tbody>
    </table>
    <hr>
    <P class="copy_wirght" style="font-size:10px; text-align:center;">THIS IS A SYSTEM GENERATED INVOICE. NO SIGNATURE REQUIRED.</P>
</div>

<div>

</div>


<div class="invoice-details" style="page-break-before: always;">
    <img src="http://mobitalk.deltaminds.com/wp-content/uploads/2024/05/DUPLICATE-FOR-SELLERS-1.png" width="100%" />
</div>

<hr />
<DIV>

    <div class="customer-info" STYLE="FLOAT:left;MARGIN:15PX">
        <h2>CUSTOMER INFORMATION</h2>
        <p>NAME: <%= customer.name %>
        </p>
        <p>ADDRESS:<%= customer.address %>
        </p>
        <p>
            <%= customer.city %> PIN:<%= customer.postcode %>
        </p>
        <P>STATE: <%= customer.state %>
        </P>
        <p>PHONE: <%= customer.phone %>
        </p>
        <h3>CUSTOMER GST: <%= customer.address_2 %>
        </h3>

    </div>

    <div class="customer-info" style="float:right;margin:20px">
        INVOICE NO:<%= order_number_format %><br />
        DATE: <%= created_at %>
    </div>


</DIV>
<div class="item-details">
    <table>
        <thead>
            <tr>
                <th>SL</th>
                <th>Description</th>
                <th>HSN Code</th>
                <th>Quantity</th>
                <th>Rate</th>
                <th>Ammount</th>
            </tr>
        </thead>
        <tbody>
            <% items.forEach(function(item){ %>
            <tr>
                <td>
                    <%= serial_two++ %>
                </td>
                <td>
                    <%=item.name%>
                    <p>IMEI1:<%=item.product.sku%>
                    </p>

                </td>
                <td>85171300</td>
                <td>
                    <%=item.qty%>
                </td>
                <td>
                    <%=item.total_currency_formatted %> %>
                </td>
                <td>
                    <%= (parseFloat(item.total_currency_formatted) * 1.18).toFixed(2) %>
                </td>

            </tr>


            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>CGST(9%):</td>
                <td>
                    <%= (parseFloat(item.total_currency_formatted) * 0.09).toFixed(2) %>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>SGST(9%):</td>
                <td>
                    <%= (parseFloat(item.total_currency_formatted) * 0.09).toFixed(2) %>
                </td>
            </tr>
            <% }); %>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><strong>GRAND TOTAL:</strong></td>
                <td><strong>
                        <%= grand_total_currency_formatted %>
                    </strong></td>
            </tr>
            <tr>
                <td COLSPAN=6><STRONG>FINANCE DETAILS</STRONG></td>
            </tr>

            <tr>
                <td COLSPAN=6>FINANCE BY: <%=addition_information.provider %>, DP:
                    <%=addition_information.dp %>,MONTHLY PAYMENT:
                    <%=addition_information.ma %>
                </td>
            </tr>

            <tr>
                <td colspan=6>Amount in words: </td>
            </tr>

            <tr>
                <td colspan=4>
                    <UL>
                        <LI>মোবাইল ফোনের 1 year warranty. Headphone / Charger /Battery 6 month
                            warranty </LI>
                        <LI>মোবাইল ফোনের সার্ভিসের জন্য CUSTOMER কে নিজেকে SERVICE CENTER যেতে হবে.
                            আমরা কোনো দ্বায়িত্ব নেবো না </LI>
                        <LI>বিল হারিয়ে গেলে কোনো প্রকার পরিষেবা পাওয়া যাবে না </li>
                        <li>মোবাইল বিল হয়ে যাবার পর ফেরত/বদল হয় না </LI>
                        <li>Goods once sold cannot be taken back</li>
                        <li>Tax paid at source</li>
                        <li>All goods carry the manufacturers' warranty</li>
                        <li>No exchange, No refund after the bill is done</li>
                        <li>The transaction of this bill is subject to Chandannagar Jurisdiction
                        </li>
                        <li>
                            <h4>Goods received in good condition and sealed pack</h4>
                        </li>
                    </UL>
                    <p style="margin-top:20px">Customer Signature</p>
                    <p style="margin-top:20px">Date:</p>
                </td>
                <td colspan=2>
                    <img src="http://mobitalk.deltaminds.com/wp-content/uploads/2024/05/20240508_130439-Photoroom.png-Photoroom.png" alt="" width="150px" height="80px">
                </td>
            </tr>
        </tbody>
    </table>
    <hr>
    <P class="copy_wirght" style="font-size:10px; text-align:center;">THIS IS A SYSTEM GENERATED INVOICE. NO SIGNATURE REQUIRED.</P>
</div>

<div>
</div>