$(document).ready(function () {
  // Nice Select
  $(".niceSelect").niceSelect();

  //Gallery
  // $(".gallery_popup").magnificPopup({
  //   type: "image",
  //   gallery: {
  //     enabled: true,
  //   },
  // });

  //Video Popup
  $(".modal_video_btn").modalVideo({
    youtube: {
      controls: 1,
      nocookie: true,
    },
  });

  //Select 2
  function selectTwo(selectID, placeholder) {
    $(selectID).select2({
      placeholder: placeholder,
    });
  }
  function selectTwoModal(selectID, placeholder, modalId) {
    $(selectID).select2({
      placeholder: placeholder,
      dropdownParent: $(modalId),
    });
  }
  if (document.querySelector("#selectCategory")) {
    selectTwo("#selectCategory", "Select category");
  }
  if (document.querySelector("#linkTypeSelect")) {
    selectTwo("#linkTypeSelect", "Select Type");
  }
  if (document.querySelector("#selectMember")) {
    selectTwo("#selectMember", "Select Member");
  }
  if (document.querySelector("#roleSelect")) {
    selectTwo("#roleSelect", "");
  }
  if (document.querySelector("#selectModalMember")) {
    selectTwoModal("#selectModalMember", "Select Member", "#newMemberModal");
  }
  if (document.querySelector("#selectModalTag")) {
    selectTwoModal("#selectModalTag", "Select Tag", "#newMemberModal");
  }

  $(".single_selectbox").on("select2:select", function (e) {
    //Add Class in select box
    //?Get data after select
    // var data = e.params.data;
    // console.log(data);
    //Label Change
    //!add same class on the same div in below if value is selected
    $(this).parent().addClass("floating_active");
  });

  //Counter
  $(".count-num").rCounter({
    duration: 30,
  });
  //Text Editor
  if (document.querySelector("#textEditor")) {
    $("#textEditor").summernote({
      placeholder: "Add descriptions",
      tabsize: 2,
      height: 200,
    });
  }

  //Range Slider

  $("[data-rangeslider]").rangeslider({
    // options here
    polyfill: false,
    // on init
    onInit: function (value) {},

    // on slide
    onSlide: function (position, value) {
      $("#rangeValue").text(value);
    },

    // on slide end
    onSlideEnd: function (position, value) {},
  });
});

//Add Class
function displayItem(addID, addClass, ovlerlayID) {
  let addDiv = document.querySelector(`#${addID}`);
  let ovlerlayDiv = document.querySelector(`#${ovlerlayID}`);
  addDiv.classList.toggle(addClass);
  ovlerlayDiv.style.cssText = "  display: block;";
}
//Remove Class
function removeDisplayItem(removeID, removeClass, ovlerlayID) {
  let addDiv = document.querySelector(`#${removeID}`);
  let ovlerlayDiv = document.querySelector(`#${ovlerlayID}`);
  addDiv.classList.toggle(removeClass);
  ovlerlayDiv.style.cssText = "  display: none;";
}

//OutSide Scroll Hidden
function scrollOutsideHidden() {
  let htmlTag = document.querySelector("html");
  htmlTag.style.cssText = "overflow:hidden;";
}
//OutSide Scroll Scroll
function scrollOutsideScroll() {
  let htmlTag = document.querySelector("html");
  htmlTag.style.cssText = "overflow:auto;";
}

//Checkbox Function
function checkboxShowHide(checkbox, checkboxArea) {
  let checkboxDiv = document.querySelector(checkbox);
  let checkboxAreaDiv = document.querySelector(checkboxArea);
  if (checkboxDiv.checked) {
    checkboxAreaDiv.style.cssText = "  display:blcok";
  } else {
    checkboxAreaDiv.style.cssText = "  display:none";
  }
}

//Sticky Navbar
let headerWrapper = document.querySelector("#headerWrapper");
if (headerWrapper) {
  window.addEventListener("scroll", () => {
    headerWrapper.classList.toggle("navbar-fixed", scrollY > 50);
  });
}
//Header Responsive
let mobileSearchBtn = document.querySelector("#mobileSearchBtn");
let searchOverlay = document.querySelector("#searchOverlay");
if (mobileSearchBtn) {
  mobileSearchBtn.addEventListener("click", () => {
    displayItem("searchFormArea", "search_active", "searchOverlay");
    scrollOutsideHidden();
  });
}
if (searchOverlay) {
  searchOverlay.addEventListener("click", () => {
    removeDisplayItem("searchFormArea", "search_active", "searchOverlay");
    scrollOutsideScroll();
  });
}

// Sidebar Responsive
let menubarToggleBtn = document.querySelector("#menubarToggleBtn");
let sidebarOverlay = document.querySelector("#sidebarOverlay");
if (menubarToggleBtn) {
  menubarToggleBtn.addEventListener("click", () => {
    document.querySelector("body").classList.toggle("sidebar_toggle");
    if (window.innerWidth <= 991) {
      sidebarOverlay.style.cssText = "display:block;    top: 60px;";
      scrollOutsideHidden();
    }
  });
}
if (sidebarOverlay) {
  sidebarOverlay.addEventListener("click", () => {
    document.querySelector("body").classList.remove("sidebar_toggle");
    sidebarOverlay.style.cssText = "display:none;    top: 60px;";
    scrollOutsideScroll();
  });
}

//User Dropdown
let userDropdownBtn = document.querySelector("#userDropdownBtn");
let userOverlay = document.querySelector("#userOverlay");
if (userDropdownBtn) {
  userDropdownBtn.addEventListener("click", () => {
    displayItem("userDropdownArea", "dropdown_active", "userOverlay");
  });
}
if (userOverlay) {
  userOverlay.addEventListener("click", () => {
    removeDisplayItem("userDropdownArea", "dropdown_active", "userOverlay");
  });
}

//Notifications Dropdown
let notificationDropdownBtn = document.querySelector(
  "#notificationDropdownBtn"
);
let notificationOverlay = document.querySelector("#notificationOverlay");
if (notificationDropdownBtn) {
  notificationDropdownBtn.addEventListener("click", () => {
    displayItem(
      "notificationDropdownArea",
      "dropdown_active",
      "notificationOverlay"
    );
  });
}
if (notificationOverlay) {
  notificationOverlay.addEventListener("click", () => {
    removeDisplayItem(
      "notificationDropdownArea",
      "dropdown_active",
      "notificationOverlay"
    );
  });
}

// Form Validation Methods Using Bootstrap 5
(function () {
  "use strict";

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll(".needs-validation");

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms).forEach(function (form) {
    form.addEventListener(
      "submit",
      function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }

        form.classList.add("was-validated");
      },
      false
    );
  });
})();

//Slider Single
function swiperSldier(
  sliderID,
  sliderNextArrow,
  sliderPrevArrow,
  breakPoint = {},
  space = 10,
  sliderSpeed = 1050
) {
  var swiper = new Swiper(`${sliderID} .swiper`, {
    spaceBetween: space,
    speed: sliderSpeed,
    keyboard: {
      enabled: true,
      // onlyInViewport: true,
    },
    breakPoint: {},
    navigation: {
      nextEl: sliderNextArrow,
      prevEl: sliderPrevArrow,
    },
  });
}

//Testimonial
swiperSldier(
  ".testimonial_slider_area",
  ".testimonial_next_icon",
  ".testimonial_prev_icon"
);
//Learning
swiperSldier(
  ".learning_slider_area",
  ".learning_next_icon",
  ".learning_prev_icon"
);

//Transfer Slider
let swiperTransfer = new Swiper(".transfer_slider_area .swiper", {
  slidesPerView: "auto",
  slidesPerGroupAuto: true,
  spaceBetween: 10,
  navigation: {
    nextEl: ".transfer_next_icon",
    prevEl: ".transfer_prev_icon",
  },
});
//Product Table Input
let tableMainCheckbox = document.querySelector("#tableMainCheckbox");
let tableCheckbox = document.querySelectorAll("#tableCheckbox");
if (tableMainCheckbox) {
  tableMainCheckbox.addEventListener("click", () => {
    if (tableMainCheckbox.checked) {
      tableCheckbox.forEach((item) => {
        if (!item.checked) {
          item.checked = true;
        }
      });
    } else {
      tableCheckbox.forEach((item) => {
        if (item.checked) {
          item.checked = false;
        }
      });
    }
  });
}

//Add Product Checkbox
let taxCheckbox = document.querySelector("#taxCheckbox");
if (taxCheckbox) {
  taxCheckbox.addEventListener("click", () => {
    checkboxShowHide("#taxCheckbox", "#taxCheckboxArea");
  });
}
let shippingCheckbox = document.querySelector("#shippingCheckbox");
if (shippingCheckbox) {
  shippingCheckbox.addEventListener("click", () => {
    checkboxShowHide("#shippingCheckbox", "#shippingCheckboxArea");
  });
}

//Task List
let taskList = document.querySelectorAll("#taskList .form-check-input");
for (let x of taskList) {
  x.addEventListener("click", () => {
    if (x.checked) {
      x.parentElement.parentElement.classList.add("checked");
    } else {
      x.parentElement.parentElement.classList.remove("checked");
    }
  });
}

// Tagify Input
//! Source:  https://yaireo.github.io/tagify/

if (document.querySelector("input[name=tags-regular]")) {
  var input = document.querySelector("input[name=tags-regular]"),
    tagify = new Tagify(input, {
      pattern: /^.{0,20}$/, // Validate typed tag(s) by Regex. Here maximum chars length is defined as "20"
      delimiters: ",| ", // add new tags when a comma or a space character is entered
      keepInvalidTags: true, // do not remove invalid tags (but keep them marked as invalid)
      // createInvalidTags: false,
      editTags: {
        clicks: 2, // single click to edit a tag
        keepInvalid: false, // if after editing, tag is invalid, auto-revert
      },
      maxTags: 6,
      blacklist: ["foo", "bar", "baz"],
      whitelist: [
        "temple",
        "stun",
        "detective",
        "sign",
        "passion",
        "routine",
        "deck",
        "discriminate",
        "relaxation",
        "fraud",
        "attractive",
        "soft",
        "forecast",
        "point",
        "thank",
        "stage",
        "eliminate",
        "effective",
        "flood",
        "passive",
        "skilled",
        "separation",
        "contact",
        "compromise",
        "reality",
        "district",
        "nationalist",
        "leg",
        "porter",
        "conviction",
        "worker",
        "vegetable",
        "commerce",
        "conception",
        "particle",
        "honor",
        "stick",
        "tail",
        "pumpkin",
        "core",
        "mouse",
        "egg",
        "population",
        "unique",
        "behavior",
        "onion",
        "disaster",
        "cute",
        "pipe",
        "sock",
        "dialect",
        "horse",
        "swear",
        "owner",
        "cope",
        "global",
        "improvement",
        "artist",
        "shed",
        "constant",
        "bond",
        "brink",
        "shower",
        "spot",
        "inject",
        "bowel",
        "homosexual",
        "trust",
        "exclude",
        "tough",
        "sickness",
        "prevalence",
        "sister",
        "resolution",
        "cattle",
        "cultural",
        "innocent",
        "burial",
        "bundle",
        "thaw",
        "respectable",
        "thirsty",
        "exposure",
        "team",
        "creed",
        "facade",
        "calendar",
        "filter",
        "utter",
        "dominate",
        "predator",
        "discover",
        "theorist",
        "hospitality",
        "damage",
        "woman",
        "rub",
        "crop",
        "unpleasant",
        "halt",
        "inch",
        "birthday",
        "lack",
        "throne",
        "maximum",
        "pause",
        "digress",
        "fossil",
        "policy",
        "instrument",
        "trunk",
        "frame",
        "measure",
        "hall",
        "support",
        "convenience",
        "house",
        "partnership",
        "inspector",
        "looting",
        "ranch",
        "asset",
        "rally",
        "explicit",
        "leak",
        "monarch",
        "ethics",
        "applied",
        "aviation",
        "dentist",
        "great",
        "ethnic",
        "sodium",
        "truth",
        "constellation",
        "lease",
        "guide",
        "break",
        "conclusion",
        "button",
        "recording",
        "horizon",
        "council",
        "paradox",
        "bride",
        "weigh",
        "like",
        "noble",
        "transition",
        "accumulation",
        "arrow",
        "stitch",
        "academy",
        "glimpse",
        "case",
        "researcher",
        "constitutional",
        "notion",
        "bathroom",
        "revolutionary",
        "soldier",
        "vehicle",
        "betray",
        "gear",
        "pan",
        "quarter",
        "embarrassment",
        "golf",
        "shark",
        "constitution",
        "club",
        "college",
        "duty",
        "eaux",
        "know",
        "collection",
        "burst",
        "fun",
        "animal",
        "expectation",
        "persist",
        "insure",
        "tick",
        "account",
        "initiative",
        "tourist",
        "member",
        "example",
        "plant",
        "river",
        "ratio",
        "view",
        "coast",
        "latest",
        "invite",
        "help",
        "falsify",
        "allocation",
        "degree",
        "feel",
        "resort",
        "means",
        "excuse",
        "injury",
        "pupil",
        "shaft",
        "allow",
        "ton",
        "tube",
        "dress",
        "speaker",
        "double",
        "theater",
        "opposed",
        "holiday",
        "screw",
        "cutting",
        "picture",
        "laborer",
        "conservation",
        "kneel",
        "miracle",
        "brand",
        "nomination",
        "characteristic",
        "referral",
        "carbon",
        "valley",
        "hot",
        "climb",
        "wrestle",
        "motorist",
        "update",
        "loot",
        "mosquito",
        "delivery",
        "eagle",
        "guideline",
        "hurt",
        "feedback",
        "finish",
        "traffic",
        "competence",
        "serve",
        "archive",
        "feeling",
        "hope",
        "seal",
        "ear",
        "oven",
        "vote",
        "ballot",
        "study",
        "negative",
        "declaration",
        "particular",
        "pattern",
        "suburb",
        "intervention",
        "brake",
        "frequency",
        "drink",
        "affair",
        "contemporary",
        "prince",
        "dry",
        "mole",
        "lazy",
        "undermine",
        "radio",
        "legislation",
        "circumstance",
        "bear",
        "left",
        "pony",
        "industry",
        "mastermind",
        "criticism",
        "sheep",
        "failure",
        "chain",
        "depressed",
        "launch",
        "script",
        "green",
        "weave",
        "please",
        "surprise",
        "doctor",
        "revive",
        "banquet",
        "belong",
        "correction",
        "door",
        "image",
        "integrity",
        "intermediate",
        "sense",
        "formal",
        "cane",
        "gloom",
        "toast",
        "pension",
        "exception",
        "prey",
        "random",
        "nose",
        "predict",
        "needle",
        "satisfaction",
        "establish",
        "fit",
        "vigorous",
        "urgency",
        "X-ray",
        "equinox",
        "variety",
        "proclaim",
        "conceive",
        "bulb",
        "vegetarian",
        "available",
        "stake",
        "publicity",
        "strikebreaker",
        "portrait",
        "sink",
        "frog",
        "ruin",
        "studio",
        "match",
        "electron",
        "captain",
        "channel",
        "navy",
        "set",
        "recommend",
        "appoint",
        "liberal",
        "missile",
        "sample",
        "result",
        "poor",
        "efflux",
        "glance",
        "timetable",
        "advertise",
        "personality",
        "aunt",
        "dog",
      ],
      transformTag: transformTag,
      backspace: "edit",
      placeholder: "Type something",
      dropdown: {
        enabled: 1, // show suggestion after 1 typed character
        fuzzySearch: false, // match only suggestions that starts with the typed characters
        position: "text", // position suggestions list next to typed text
        caseSensitive: true, // allow adding duplicate items if their case is different
      },
      templates: {
        dropdownItemNoMatch: function (data) {
          return `<div class='${this.settings.classNames.dropdownItem}' value="noMatch" tabindex="0" role="option">
                    No suggestion found for: <strong>${data.value}</strong>
                </div>`;
        },
      },
    });

  // generate a random color (in HSL format, which I like to use)
  function getRandomColor() {
    function rand(min, max) {
      return min + Math.random() * (max - min);
    }

    var h = rand(1, 360) | 0,
      s = rand(40, 70) | 0,
      l = rand(65, 72) | 0;

    return "hsl(" + h + "," + s + "%," + l + "%)";
  }

  function transformTag(tagData) {
    tagData.color = getRandomColor();
    tagData.style = "--tag-bg:" + tagData.color;

    if (tagData.value.toLowerCase() == "shit") tagData.value = "s✲✲t";
  }

  // tagify.on("add", function (e) {
  //   console.log(e.detail);
  // });

  // tagify.on("invalid", function (e) {
  //   console.log(e, e.detail);
  // });

  var clickDebounce;

  tagify.on("click", function (e) {
    const { tag: tagElm, data: tagData } = e.detail;

    // a delay is needed to distinguish between regular click and double-click.
    // this allows enough time for a possible double-click, and noly fires if such
    // did not occur.
    clearTimeout(clickDebounce);
    clickDebounce = setTimeout(() => {
      tagData.color = getRandomColor();
      tagData.style = "--tag-bg:" + tagData.color;
      tagify.replaceTag(tagElm, tagData);
    }, 200);
  });

  tagify.on("dblclick", function (e) {
    // when souble clicking, do not change the color of the tag
    clearTimeout(clickDebounce);
  });
}

//Sales Checkbox
let salesCheckboxList = document.querySelectorAll(
  "#salesCheckboxList .form-check-input"
);
let deselectAllBtn = document.querySelector("#deselectAllBtn");
if (deselectAllBtn) {
  deselectAllBtn.addEventListener("click", () => {
    salesCheckboxList.forEach((item) => {
      if (item.checked) {
        item.checked = false;
      }
    });
  });
}

//Search Form Functionlity
let openSearchBtn = document.querySelector("#openSearchBtn");
let searchFormWrapper = document.querySelector("#searchFormWrapper");
let closeSearchBtn = document.querySelector("#closeSearchBtn");
if (openSearchBtn) {
  openSearchBtn.addEventListener("click", () => {
    openSearchBtn.classList.toggle("search_btn_active");
    searchFormWrapper.classList.toggle("search_active");
  });
}
if (closeSearchBtn) {
  closeSearchBtn.addEventListener("click", () => {
    openSearchBtn.classList.remove("search_btn_active");
    searchFormWrapper.classList.remove("search_active");
  });
}
//Float Form
let floatingInputs = document.querySelectorAll(
  "#floatingFormArea .input_filed"
);
function inputValidate(item, targetValue) {
  let inputRow = item.parentElement;
  if (targetValue > 0) {
    inputRow.classList.add("floating_active");
  } else {
    inputRow.classList.remove("floating_active");
  }
}
floatingInputs.forEach((item) => {
  if (item.value.length > 0) {
    inputValidate(item, item.value.length);
  } else {
    item.addEventListener("change", (e) => {
      inputValidate(item, e.target.value.length);
    });
  }
});
// ScrollToUp
window.addEventListener("scroll", function () {
  var scroll = document.querySelector(".scrolltop");
  scroll.classList.toggle("scroll_active", window.scrollY > 500);
});

function scrollUp() {
  window.scrollTo({
    top: 0,
    behavior: "smooth",
  });
}

//Outside Click Detect
function outSideDetect(
  clickId,
  dropdownId,
  dropdownRemoveId,
  dropdownRemoveClass
) {
  document.addEventListener("click", function (event) {
    let clickDiv = document.querySelector(`#${clickId}`);
    let dropdownDiv = document.querySelector(`#${dropdownId}`);
    let dropdownRemoveDiv = document.querySelector(`#${dropdownRemoveId}`);
    let isClickInside = clickDiv.contains(event.target);
    let isClickOutside = dropdownDiv.contains(event.target);
    if (!isClickInside && !isClickOutside) {
      dropdownRemoveDiv.classList.remove(dropdownRemoveClass);
    }
  });
}
