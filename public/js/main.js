(function ($) {
  function toggleDropdown(e) {
    const _d = $(e.target).closest(".dropdown"),
      _m = $(".dropdown-menu", _d);
    setTimeout(
      function () {
        const shouldOpen = e.type !== "click" && _d.is(":hover");
        _m.toggleClass("show", shouldOpen);
        _d.toggleClass("show", shouldOpen);
        $('[data-toggle="dropdown"]', _d).attr("aria-expanded", shouldOpen);
      },
      e.type === "mouseleave" ? 100 : 0
    );
  }

  $("body")
    .on("mouseenter mouseleave", ".dropdown", toggleDropdown)
    .on("click", ".dropdown-menu a", toggleDropdown);
  /*  $(".dropdown").hover(function () {
        
        $(this).find('.dropdown-menu').addClass('show');
    });*/

  $(document).scroll(function () {
    var y = $(this).scrollTop();
    if (y > 300) {
      $(".top-btn").fadeIn();
    } else {
      $(".top-btn").fadeOut();
    }
  });
  $(".owl-carousel").owlCarousel({
    loop: true,
    margin: 10,
    mouseDrag: false,
    touchDrag: false,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
        nav: true,
      },
      600: {
        items: 1,
        nav: false,
      },
      1000: {
        items: 1,
        nav: true,
        loop: true,
      },
    },
  });

  new WOW().init();
})(jQuery);

function topFunction() {
  $("html,body").animate({ scrollTop: 0 }, "slow");
}

function comment(news_id) {
  webix
    .ui({
      view: "window",
      position: "center",
      modal: true,
      id: "comm",
      width: 450,
      head: "Ваш комментарий",
      body: {
        rows: [
          {
            view: "textarea",
            id: "comment",
            label: "Комментарий",
            labelWidth: 95,
          },
          {
            cols: [
              {
                view: "button",
                value: "Добавить",
                click: function () {
                  webix.ajax().post(
                    "add_comm.php",
                    {
                      comment: $$("comment").getValue(),
                      news_id: news_id,
                    },
                    function (text) {
                      if (text == 1) {
                        $$("comm").destructor();
                        webix.message({
                          text:
                            "Спасибо,ваш комментарий отправлен и будет опубликован после модерации!",
                          type: "success",
                        });
                        // location.reload();
                      }
                    }
                  );
                },
              },
              {
                view: "button",
                value: "Отмена",
                click: "$$('comm').destructor()",
              },
            ],
          },
        ],
      },
    })
    .show();
}

window.onload = function () {
  let preheader = document.querySelector(".pre-header"),
    preheadersDiv = document.querySelector(".pre-header + div");
  preheadersDiv.style.paddingTop = preheader.offsetHeight + 10 + "px";
  window.onscroll = function () {
    if (window.scrollY <= preheader.offsetHeight) {
      preheader.style.backgroundColor = "#f3f4f7";
    } else {
      preheader.style.backgroundColor = "transparent";
    }
  };
};
