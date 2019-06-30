const $$ = parameter => {
  return document.querySelector(parameter);
};

//set change listener on discount and tax beginning
let show = false;
const toggleHandler = () => {
  show = !show;
  if (show) {
    document.querySelector(".forDropDown").classList.add("slideDown");
  } else {
    document.querySelector(".forDropDown").classList.remove("slideDown");
  }
};

const taxChange = () => {
  console.log($$("#discountInvoice").value);
  switch ($$("#typeTaxInvoice").value) {
    case "None":
      $("#taxControlContainer").html(` <div id="customSelectTypeTax">
                    
                      <label for="type" style="width: 100%;">Type</label> 
                      <select name="type" id="typeTaxInvoice">
                        <option selected value="None">None</option>
                        <option value="Deducted">Deducted</option>
                        <option value="On Total">On Total</option>
                      </select>
                                     
                   </div>
              
              `);
      $$("#typeTaxInvoice").addEventListener("change", taxChange);

      break;
    case "On Total":
      $("#taxControlContainer").html(`

              <div id="customSelectTypeTax">
                    
                      <label for="type" style="width: 100%;">Type</label> 
                      <select value="On Total"name="type" id="typeTaxInvoice">
                        <option value="None">None</option>
                        <option value="Deducted">Deducted</option>
                        <option selected value="On Total">On Total</option>
                      </select>
                                     
                   </div>

              <div style="width: 100%; position: relative"><label for="myPercent" style="margin-top:20px;">Rate</label> 
                     <input onkeyup='onChangeHandler()' type="number" min="0" max="100" value="0.00" step="0.01" id="myPercent"/>
                     <span style="position: absolute;
                                  bottom: 7px;
                                  right: 30px;
                                  font-size: 18px;">%</span>
                     
                     </div>`);
      $$("#typeTaxInvoice").addEventListener("change", taxChange);
      onChangeHandler();
      break;
    case "Per Item":
      $("#taxControlContainer").html(` <div id="customSelectTypeTax">
                    
                      <label for="type" style="width: 100%;">Type</label> 
                      <select value="Per Item" name="type" id="typeTaxInvoice">
                        <option>None</option>
                        <option value="Deducted">Deducted</option>
                        <option value="On Total">On Total</option>
                      </select>
                                     
                   </div>
              
              `);
      $$("#typeTaxInvoice").addEventListener("change", taxChange);
      onChangeHandler();

      break;
    case "Deducted":
      $("#taxControlContainer").html(`

                <div id="customSelectTypeTax">
      
      </div> 
        <label for="type" style="width: 100%;">Type</label> 
        <select value="Deducted" name="type" id="typeTaxInvoice">
          <option value="None">None</option>
          <option selected value="Deducted">Deducted</option>
          <option value="On Total">On Total</option>
        </select>
                       
     </div>

          <div style="width: 100%; position: relative"><label for="myPercent" style="margin-top:20px;">Rate</label> 
       <input type="number" onkeyup="onChangeHandler()" min="0" max="100" value="0.00" step="0.01" id="myPercent"/>
       <span style="position: absolute;
                    bottom: 7px;
                    right: 30px;
                    font-size: 18px;">%</span>
       
       </div>`);
      $$("#typeTaxInvoice").addEventListener("change", taxChange);
      onChangeHandler();
      break;

    default:
      $("#taxControlContainer").html(` <div id="customSelectTypeTax">
                    
                      <label for="type" style="width: 100%;">Type</label> 
                      <select name="type" id="typeTaxInvoice">
                        <option value="None">None</option>
                        <option value="Deducted">Deducted</option>
                        <option value="On Total">On Total</option>
                      </select>                          
                   </div>
              `);
      $$("#typeTaxInvoice").addEventListener("change", taxChange);
      onChangeHandler();
  }
};
//DISCOUNT//
const discountChange = () => {
  switch ($$("#discountInvoice").value) {
    case "None":
      $("#discountControlContainer").html(`
                   <div id="customSelectDiscount">
                      <select name="discount" value="None" id="discountInvoice">
                        <option class='None' value="None">None</option>
                        <option value="Percent">Percent</option>
                        <option value="Flat Amount">Flat Amount</option>
                      </select>
                  </div>           
              
              `);
      $$("#discountInvoice").addEventListener("change", discountChange);
      onChangeHandler();

      break;
    case "Flat Amount":
      $("#discountControlContainer").html(`

              <div id="customSelectDiscount">
                      <select name="discount" value="Flat Amount" id="discountInvoice">
                        <option class='None' value="None">None</option>
                        <option value="Percent">Percent</option>
                        <option selected value="Flat Amount">Flat Amount</option>
                      </select>
                     <div id="labelTaxContInvoice">
                     <label for="amount">Amount</label> 
                     <input type="number" name="amount" onkeyup="onChangeHandler()" id="amountDiscount" placeholder="Amount" step="1.00" value="0.00"/>
                    </div> 
              </div>   
                    `);
      $$("#discountInvoice").addEventListener("change", discountChange);
      onChangeHandler();
      break;
    case "Percent":
      $("#discountControlContainer").html(`
            <div id="customSelectDiscount">
                      <select name="discount" value="Percent" id="discountInvoice">
                        <option class='None' value="None">None</option>
                        <option selected value="Percent">Percent</option>
                        <option value="Flat Amount">Flat Amount</option>
                      </select>
                     
                    <div style="width: 100%; position: relative">
                        <label for="myPercent" style="margin-top:20px;">Rate</label> 
                      <input type="number" onkeyup="onChangeHandler()" min="0" max="100" value="0.00" step="0.01" id="myPercentDiscount"/>
                      <span style="position: absolute;
                      bottom: 7px;
                      right: 30px;
                      font-size: 18px;">%</span>
                      </div>
              </div>   
            
          
              
              `);
      $$("#discountInvoice").addEventListener("change", discountChange);
      onChangeHandler();

      break;

    default:
      $("#discountControlContainer").html(` <div id="customSelectDiscount">
                      <select name="discount" value="None" id="discountInvoice">
                        <option class='None' value="None">None</option>
                        <option value="Percent">Percent</option>
                        <option value="Flat Amount">Flat Amount</option>
                      </select>
                  </div>   
              `);
      $$("#discountInvoice").addEventListener("change", discountChange);
      onChangeHandler();
  }
};

//END OF DISCOUNT//
$$("#typeTaxInvoice").addEventListener("change", taxChange);
$$("#discountInvoice").addEventListener("change", discountChange);

//end of set change listener on discount and tax

//get a uuid first
function uuidv4() {
  return "xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(/[xy]/g, function(c) {
    var r = (Math.random() * 16) | 0,
      v = c == "x" ? r : (r & 0x3) | 0x8;
    return v.toString(16);
  });
}
if ($$(".descriptionRowInvoice").getAttribute("data-src") === "go") {
  console.log("bbb");
  $$(".descriptionRowInvoice").id = uuidv4();
}
// document.querySelector(".descriptionRowInvoice").id = uuidv4();
let myCountries = [];
let invoiceIdentifier;
invoiceIdentifier = $$(".logo").getAttribute("data-src");

if ($$(".logo").getAttribute("data-src") === "") {
  invoiceIdentifier = uuidv4();
}
$$(".prev").id = invoiceIdentifier;
$$("#download").className = invoiceIdentifier;
$$("#email").className = invoiceIdentifier;

console.log(invoiceIdentifier);
let currencySymbol = ".";

//beggining of Currency change Handler

const onCurrencyChangeHandler = () => {
  if (
    document.querySelectorAll("#currencyControlContainer option").length === 250
  ) {
    let symbol = $$("#currencyContInvoice").value.split(" ")[0];
    currencyUpdate(symbol);
    currencySymbol = symbol;
    console.log(symbol, "symbol");
  }
};

//end of currency Change handler

const currencyUpdate = currencySymbol => {
  $$(
    "#labelsInvoice"
  ).innerHTML = `<li><h5>Subtotal</h5> <h5 id="subtotalValueInvoice">${currencySymbol} 0.00</h5></li>
                                <li><h5>Discount(<span id="discountTag">0%</span>)</h5> <h5 id="discountValueInvoice">${currencySymbol} 0.00</h5></li>
                                <li><h5>Tax(<span id="taxPercentTag">0%</span>)</h5> <h5 id="taxValueInvoice">${currencySymbol} 0.00</h5></li>
                               
                                <li><h5>Balance Due</h5> <h5 id="balanceDueValueInvoice">${currencySymbol} 0.00</h5></li>`;
  $$("#amountInvoiceInput h6").innerText = currencySymbol + " " + "0.00";
  console.log(currencySymbol);
  if ($$("#bamount").getAttribute("data-src") !== "okay") {
    $$("th#bamount").innerText = currencySymbol + " " + "0.00";
  }
};

$.ajax({
  type: "GET",
  url: "https://api.ipify.org",
  success: function(ip) {
    console.log(ip);
    myCountries.push(allCountryData());
    console.log(myCountries);
    if ($$("#currencyContInvoice").getAttribute("data-src") != "no") {
      console.log(
        $$("#currencyContInvoice").getAttribute("data-src"),
        "the att"
      );
      $("#currencyContInvoice").append(
        myCountries[0].map(c => {
          if (
            $$("#currencyContInvoice").getAttribute("data-src") ==
            c.currencies[0].symbol
          ) {
            currencySymbol = c.currencies[0].symbol;
            if ($$("#subList").getAttribute("data-src") == "subList") {
              currencyUpdate(currencySymbol);
            }
            return `<option selected value=${c.currencies[0].symbol}><p>${
              c.currencies[0].symbol
            }</p> <p> ${c.name}</p></option>`;
          }
          return `<option value=${c.currencies[0].symbol}><p>${
            c.currencies[0].symbol
          }</p> <p> ${c.name}</p></option>`;
        })
      );
      const loaderWrapper = document.querySelector(".loader-wrapper");

      setTimeout(() => {
        loaderWrapper.style.transition = ".5s";
        loaderWrapper.style.opacity = "0";
      }, 1000);
      setTimeout(() => {
        loaderWrapper.style.display = "none";
      }, 1900);
      // console.log()
    } else {
      $.ajax({
        url: `http://api.ipstack.com/${ip}?access_key=1883e7756823e88f22eb2fc876d8f536`,

        success: function(location) {
          // Remove Loader
          const loaderWrapper = document.querySelector(".loader-wrapper");

          setTimeout(() => {
            loaderWrapper.style.transition = ".8s";
            loaderWrapper.style.opacity = "0";
          }, 2000);
          setTimeout(() => {
            loaderWrapper.style.display = "none";
          }, 2900);
          // Remove Loader End
          console.log(location.country_name);

          $("#currencyContInvoice").append(
            myCountries[0].map(c => {
              if (c.name === location.country_name) {
                currencySymbol = c.currencies[0].symbol;
                if ($$("#subList").getAttribute("data-src") == "subList") {
                  currencyUpdate(currencySymbol);
                }
                return `<option selected value=${c.currencies[0].symbol}><p>${
                  c.currencies[0].symbol
                }</p> <p> ${c.name}</p></option>`;
              }
              return `<option value=${c.currencies[0].symbol}><p>${
                c.currencies[0].symbol
              }</p> <p> ${c.name}</p></option>`;
            })
          );
        }
      });
    }
  }
});

// COLOR PICKER ALGORITHM
let pickedColor = $$("#colorPickerInvoice").value || "#477fae";
const colorPickerHandler = event => {
  $$("#topDesignInvoice").style.background = event.target.value;
  $$("#descriptionHeaderInvoice").style.background = event.target.value;
  $$(".closeProductDescInvoice").style.color = event.target.value;
  $$("#addDescInvoice").style.color = event.target.value;

  document.querySelectorAll(".closeProductDescInvoice").forEach(c => {
    c.style.color = event.target.value;
  });
  document.querySelectorAll(".addDescInvoice").forEach(c => {
    c.style.color = event.target.value;
  });
};
const colorPicker = $$("#colorPickerInvoice");

colorPicker.addEventListener("change", e => {
  console.log(e);
  pickedColor = e.target.value;
  return colorPickerHandler(e);
});

// END OF COLOR PICKER ALGORITHM

//BEGINNING OF PRICE CALCULATOR ALGORITHM
const ultFloatParser = value => {
  if (value === "") {
    return 0;
  }
  if (isNaN(value)) {
    return 0;
  }
  return parseFloat(value);
};
// let checkboxTax = {};
let totalPerItemArray = [(0.0).toFixed(2)];
// let rp = 0.00;
let timeout = setTimeout(() => {
  console.log("go");
}, 10);
let balance = 0.0;
let subTotal = 0.0;
let taxValue = 0.0;
let discountValue = 0.0;

const onChangeHandler = id => {
  document.querySelectorAll(".savePreviewCont button").forEach(e => {
    e.disabled = false;
  });
  balance = 0.0;
  clearTimeout(timeout);
  timeout = setTimeout(() => {
    submitHandler();
  }, 1000);

  let priceInvoices = document.querySelectorAll(".priceInvoice");
  let qtyInvoices = document.querySelectorAll(".qtyInvoice");
  // let checkBoxInvoice = document.querySelectorAll(".taxCheckBox");
  subTotal = 0.0;
  totalPerItemArray = [];
  priceInvoices.forEach((p, i) => {
    let amountValue = (
      ultFloatParser(p.value) * ultFloatParser(qtyInvoices[i].value)
    ).toFixed(2);
    totalPerItemArray.push(amountValue);
    p.parentNode.parentNode.querySelector(".amountInvoiceInput").innerText =
      currencySymbol +
      " " +
      amountValue.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
    subTotal = ultFloatParser(subTotal) + ultFloatParser(amountValue);
    subTotal = ultFloatParser(subTotal).toFixed(2);
  });
  taxValue = 0.0;

  if ($$("#myPercent")) {
    taxValue = (
      (ultFloatParser($$("#myPercent").value) / 100) *
      ultFloatParser(subTotal)
    ).toFixed(2);
    $$("#taxPercentTag").innerText = $$("#myPercent").value + " %";
  }

  if ($$("#typeTaxInvoice").value === "Deducted") {
    taxValue *= -1.0;
    taxValue = taxValue.toFixed(2);
  }
  //discount
  discountValue = 0.0;
  if ($$("#amountDiscount")) {
    $$("#discountTag").innerText =
      currencySymbol + " " + $$("#amountDiscount").value;
    discountValue =
      -1.0 * ultFloatParser($$("#amountDiscount").value).toFixed(2);
  } else if ($$("#myPercentDiscount")) {
    $$("#discountTag").innerText = $$("#myPercentDiscount").value + " %";

    discountValue =
      -1.0 *
      (
        (ultFloatParser($$("#myPercentDiscount").value) / 100) *
        ultFloatParser(subTotal)
      ).toFixed(2);
  }
  $$("#bamount").innerText =
    currencySymbol +
    " " +
    (
      ultFloatParser(subTotal) +
      ultFloatParser(taxValue) +
      ultFloatParser(discountValue)
    )
      .toFixed(2)
      .toString()
      .replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");

  $$("#subtotalValueInvoice").innerText =
    currencySymbol +
    " " +
    subTotal.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
  $$("#taxValueInvoice").innerText =
    currencySymbol +
    " " +
    taxValue.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
  $$("#discountValueInvoice").innerText =
    currencySymbol +
    " " +
    discountValue.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
  $$("#balanceDueValueInvoice").innerText =
    currencySymbol +
    " " +
    (
      ultFloatParser(subTotal) +
      ultFloatParser(taxValue) +
      ultFloatParser(discountValue)
    )
      .toFixed(2)
      .toString()
      .replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");

  balance =
    ultFloatParser(subTotal) +
    ultFloatParser(taxValue) +
    ultFloatParser(discountValue);
};
console.log(balance);

// END OF CALCULATOR ALGORITHM

//BEGINNING OF PRODUCT ADDITION ALGORITHM
let inc = 1;
const addNewProductHandler = () => {
  // console.log("click add");
  $(".descriptionContainerInvoice")
    .append(`<div class="descriptionRowInvoice" id="${uuidv4()}">
                        
                        <div id="descriptionInvoiceInput" class="descriptionInvoiceInput">
                          <textarea name="description" id="description${inc}" class="description" placeholder="Describe Item"></textarea>
                        </div>
                        <div id="priceInvoiceInput" class="priceInvoiceInput">
                          <input type="text" name="price" class="priceInvoice" id="priceInvoice${inc}"  onkeyup="onChangeHandler()" step=".01" placeholder="0.00" value="0.00">
                        </div>
                        <div id="qtyInvoiceInput" class="qtyInvoiceInput">
                          <input type="text" name="description" class="qtyInvoice" id="qtyInvoice${inc}" value="1" onkeyup="onChangeHandler()" >
                        </div>
                        <div class="amountInvoiceInput" id="amountInvoiceInput${inc}">
                          <h6>${currencySymbol} 0.00</h6>
                        </div>
                        <div class="cancelItemInvoice">
                        <i class="fas fa-trash closeProductDescInvoice"></i>
                        <span class="deleteTrashInvoice" style="padding: 2px 8px; font-size: 17px; color: ${pickedColor};">Delete Item</span>
                        </div>
                      
               </div>`);

  deleteEventCall();
  colorPickerHandler({
    target: {
      value: pickedColor
    }
  });
};

//END OF PRODUCT ADDITION ALGORITHM

//BEGINNING OF PRODUCT DELETION ALGORITHM

// console.log(uuidv4())

const deleteHandler = (e, rowid) => {
  if (document.querySelectorAll(".closeProductDescInvoice").length < 2) {
    return;
  }
  console.log(rowid);
  const elemId = e.target.parentNode.parentNode;

  const filterArr = [
    ...document.querySelectorAll(`.${e.target.parentNode.parentNode.className}`)
  ].filter(p => p.id !== e.target.parentNode.parentNode.id);

  console.log(filterArr, "filterArr");
  e.target.parentNode.parentNode.parentNode.removeChild(elemId);
  onChangeHandler();
  onDeleteAsync(rowid);
};
const onDeleteAsync = rowid => {
  $.ajax({
    url: `save-invoice.php?rowid=${rowid}`,
    type: "GET",
    success: function(data) {
      console.log(data);
    }
  });
};
const deleteEventCall = () => {
  console.log(
    document.querySelectorAll(".closeProductDescInvoice").length,
    "Na d length be dis"
  );
  if (document.querySelectorAll(".closeProductDescInvoice").length < 2) {
    return;
  }

  document.querySelectorAll(".closeProductDescInvoice").forEach(x => {
    // console.log(x)
    x.addEventListener("click", e => {
      deleteHandler(e, x.parentNode.parentNode.id);
    });
  });
  document.querySelectorAll(".deleteTrashInvoice").forEach(x => {
    // console.log(x)
    x.addEventListener("click", e => {
      deleteHandler(e, x.parentNode.parentNode.id);
    });
  });
};

deleteEventCall();
onCurrencyChangeHandler();
//END OF PRODUCT DELETION ALGORITHM

//BEGINNING OF SHOW PREVIEW HANDLER

const previewInvoice = id => {
  window.location.href = `new-invoice-preview?key=${id}`;
};
const previewQuotation = id => {
  window.location.href = `quotation-preview?key=${id}`;
};

$("input:text").focus(function() {
  $(this).select();
});
$("input:text").mouseup(function(e) {
  return false;
});

document.querySelectorAll(".personalDets").forEach(i => {
  i.querySelector("input").addEventListener("focus", () => {
    i.querySelector("label").style.color = pickedColor;
    i.querySelector("label").style.transition = ".5s";
  });
});
document.querySelectorAll(".personalDets").forEach(i => {
  i.querySelector("input").addEventListener("blur", () => {
    i.querySelector("label").style.color = "#bbb";
    i.querySelector("label").style.transition = ".5s";
  });
});

const fileHandler = e => {
  console.log(e);
  var file = e.target.files[0];
  // uploads(file);
  console.log(file);
  let formData = new FormData();

  formData.append("image", file);
  $.ajax({
    type: "POST",
    url: "uploads/uploads.php",
    data: formData,
    contentType: false,
    // cache: false,
    processData: false,
    beforeSend: function() {
      $$(".invoiceLogo label").innerHTML = "Uploading Image...";
    },
    success: function(msg) {
      // console.log(msg);
      const newMsg = JSON.parse(msg);
      console.log(newMsg);
      if (newMsg.success !== undefined) {
        $$(".invoiceLogo label").innerHTML = `<img  src="./uploads/${
          newMsg.success
        }" alt=""/>
        <form id="formInvoice" enctype="multipart/form-data" name="submit" style="position: absolute"  >
                  
                    <input style="position: absolute" type="file" name="image" id="logoInvoice">
                  </form>
        
        `;
      }
      // $$(".invoiceLogo label").innerHTML = "Image Uploaded";
      $$("#logoInvoice").addEventListener("change", fileHandler);
    }
  });
};

if ($$("#logoInvoice")) {
  $$("#logoInvoice").addEventListener("change", fileHandler);
}

const logout = () => {
  $.ajax({
    url: "backend/logout.backend.php",
    datatype: "json",
    type: "post",
    data: { submit: true },
    // timeout: 5000,
    success: function(data) {
      window.location.href = "index.php?logout=success";
    }
  });
};

const emailHandler = () => {
  $.ajax({
    url: `sendquotationtoclient.php?key=${id}&url=${logoURL}`,
    type: "get",
    success: function(data) {
      console.log(data);
    }
  });
};

const downloadPDFHandler = id => {
  let logoURL = $$("#download").getAttribute("data-logo");
  window.location.href = `downloadpdfquotation.php?key=${id}&url=${logoURL}`;
};
