const submitHandler = () => {
  // Personal Details
  const invoiceTitle = $$("#invoicetitle").value;
  const fromNameInvoice = $$("#fromNameInvoice").value;
  const fromEmailInvoice = $$("#fromEmailInvoice").value;
  const address1FromInvoice = $$("#address1FromInvoice").value;
  const address2FromInvoice = $$("#address2FromInvoice").value;
  const zipcodeFromInvoice = $$("#zipcodeFromInvoice").value;
  const phoneFromInvoice = $$("#phoneFromInvoice").value;
  const businessNumberFromInvoice = $$("#businessNumberFromInvoice").value;
  const refNumberFromInvoice = $$("#refNumberFromInvoice").value;
  const dateFromInvoice = $$("#dateFromInvoice").value;
  const termsFromInvoice = $$("#termsFromInvoice").value;
  const clientNameFromInvoice = $$("#clientNameFromInvoice").value;
  const clientEmailFromInvoice = $$("#clientEmailFromInvoice").value;
  const clientAddressFromInvoice = $$("#clientAddressFromInvoice").value;
  const paymentInstructionsAddNotes = $$(
    ".paymentInstructionsAddNotes textarea"
  ).value;
  const labelTax = $$("#labelTax").value || "";
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

  document.querySelectorAll(".descriptionRowInvoice").forEach((d, i) => {
    let description = d.querySelector(".descriptionInvoiceInput textarea")
      .value;
    let priceInvoice = d.querySelector(".priceInvoice").value;
    let qtyInvoice = d.querySelector(".qtyInvoice").value;
    let taxCheckBox = d.querySelector(".taxCheckBox").checked;
    let descriptionRowInvoiceId = d.id;
    let amountPerItem = totalPerItemArray[i];
    totalItemArray.push({
      description,
      priceInvoice,
      qtyInvoice,
      amountPerItem,
      taxCheckBox,
      descriptionRowInvoiceId
    });
  });
  // console.log(pickedColor, "HELLOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO");
  const invoiceDetails = {
    invoiceIdentifier,
    invoiceTitle,
    fromNameInvoice,
    fromEmailInvoice,
    address1FromInvoice,
    address2FromInvoice,
    zipcodeFromInvoice,
    phoneFromInvoice,
    businessNumberFromInvoice,
    refNumberFromInvoice,
    dateFromInvoice,
    termsFromInvoice,
    clientNameFromInvoice,
    clientEmailFromInvoice,
    clientAddressFromInvoice,
    paymentInstructionsAddNotes,
    labelTax,
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

  $.ajax({
    url: "save-invoice.php",
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
};
