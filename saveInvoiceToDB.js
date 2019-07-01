const submitHandler = () => {
  // Personal Details
  const invoiceTitle = $$("#invoicetitle").value;
  const fromNameInvoice = $$("#fromNameInvoice").value;
  const fromEmailInvoice = $$("#fromEmailInvoice").value;
  const address1FromInvoice = $$("#address1FromInvoice").value;

  const phoneFromInvoice = $$("#phoneFromInvoice").value;

  const refNumberFromInvoice = $$("#refNumberFromInvoice").value;
  const dateFromInvoice = $$("#dateFromInvoice").value;
  // const termsFromInvoice = $$("#termsFromInvoice").value;
  const clientNameFromInvoice = $$("#clientNameFromInvoice").value;
  const clientEmailFromInvoice = $$("#clientEmailFromInvoice").value;
  const clientAddressFromInvoice = $$("#clientAddressFromInvoice").value;
  const paymentInstructionsAddNotes = $$(
    ".paymentInstructionsAddNotes textarea"
  ).value;

  const typeTaxInvoice = $$("#typeTaxInvoice").value || "";
  const discountInvoice = $$("#discountInvoice").value || "";

  const myPercent = $$("#myPercent") ? $$("#myPercent").value : "";
  const amountDiscount = $$("#amountDiscount")
    ? $$("#amountDiscount").value
    : "";
  const myPercentDiscount = $$("#myPercentDiscount")
    ? $$("#myPercentDiscount").value
    : "";
  const currencyContInvoice = $$("#currencyContInvoice")
    ? $$("#currencyContInvoice").value
    : "";
  // Product Details
  let totalItemArray = [];
  let user_identification = $$(".ycontainer").getAttribute("data-src");
  document.querySelectorAll(".descriptionRowInvoice").forEach((d, i) => {
    let description = d.querySelector(".descriptionInvoiceInput textarea")
      .value;
    let priceInvoice = d.querySelector(".priceInvoice").value;
    let qtyInvoice = d.querySelector(".qtyInvoice").value;

    let descriptionRowInvoiceId = d.id;
    let amountPerItem = totalPerItemArray[i];
    totalItemArray.push({
      description,
      priceInvoice,
      qtyInvoice,
      amountPerItem,

      descriptionRowInvoiceId
    });
  });

  const invoiceDetails = {
    invoiceIdentifier,
    invoiceTitle,
    fromNameInvoice,
    fromEmailInvoice,
    address1FromInvoice,
    user_identification,
    phoneFromInvoice,
    refNumberFromInvoice,
    dateFromInvoice,
    // termsFromInvoice,
    clientNameFromInvoice,
    clientEmailFromInvoice,
    clientAddressFromInvoice,
    paymentInstructionsAddNotes,
    typeTaxInvoice,
    discountInvoice,
    pickedColor,
    myPercent,
    amountDiscount,
    myPercentDiscount,
    currencyContInvoice,
    totalItemArray,
    subTotal: ultFloatParser(subTotal),
    taxValue,
    discount: discountValue,
    balance
  };

  console.log(invoiceDetails);
  if ($$(".ycontainer").getAttribute("data-page") == "invoice") {
    $.ajax({
      url: "save-invoice.php",
      datatype: "json",
      type: "post",
      data: { save: JSON.stringify(invoiceDetails) },
      success: function(data) {
        console.log(data);
        if (
          clientEmailFromInvoice.length > 0 &&
          clientNameFromInvoice.length > 0 &&
          clientAddressFromInvoice.length > 0
        ) {
          document.querySelectorAll(".savePreviewCont button").forEach(e => {
            e.disabled = false;
          });
        }
        $$("#email").setAttribute("data-client", clientEmailFromInvoice);
      },
      error: function(xhr, textStatus, errorThrown) {
        alert(`${errorThrown}`);
      }
    });
  } else {
    $.ajax({
      url: "save-quotation.php",
      datatype: "json",
      type: "post",
      data: { save: JSON.stringify(invoiceDetails) },
      success: function(data) {
        console.log(data);
      },
      error: function(xhr, textStatus, errorThrown) {
        alert(`${errorThrown}`);
      }
    });
  }
};
