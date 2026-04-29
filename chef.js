
const prevBtn = document.querySelector(".chefs-slider .prev");
const nextBtn = document.querySelector(".chefs-slider .next");
const chefsContainer = document.querySelector(".chefs-container");

if (prevBtn && nextBtn && chefsContainer) {
  function getScrollAmount() {
    const item = document.querySelector(".chef-item");
    if (!item) return 200;
    const style = window.getComputedStyle(item);
    return item.offsetWidth + (parseInt(style.marginRight) || 20);
  }
  nextBtn.addEventListener("click", () => {
    const maxScrollLeft = chefsContainer.scrollWidth - chefsContainer.clientWidth;
    const nextScroll = Math.min(chefsContainer.scrollLeft + getScrollAmount(), maxScrollLeft);
    chefsContainer.scrollTo({ left: nextScroll, behavior: "smooth" });
  });
  prevBtn.addEventListener("click", () => {
    const prevScroll = Math.max(chefsContainer.scrollLeft - getScrollAmount(), 0);
    chefsContainer.scrollTo({ left: prevScroll, behavior: "smooth" });
  });
}
