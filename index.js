// console.log("hey there");
const loaderWrapper = document.querySelector(".loader-wrapper");
window.onload = () => {
  // console.log("green");
  setTimeout(() => {
    loaderWrapper.style.transition = ".8s";
    loaderWrapper.style.opacity = "0";
  }, 2000);
  setTimeout(() => {
    loaderWrapper.style.display = "none";
  }, 2900);
};
