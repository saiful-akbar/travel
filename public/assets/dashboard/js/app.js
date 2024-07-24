class App {
  /**
   * Trim path url.
   *
   * @param {string} path
   * @returns {string}
   */
  static trim(path) {
    if (path.charAt(0) === "/") {
      return path.substring(1).trim();
    }

    return path.trim();
  }

  /**
   * base url.
   *
   * @param {string} path
   * @returns {string}
   */
  static url(path = "/") {
    const baseUrl = document.querySelector("meta[name=base-url]").content;

    return `${baseUrl}/${this.trim(path)}`;
  }

  /**
   * Dashboard url.
   *
   * @param {string} path
   * @returns {string}
   */
  static dashboardUrl(path = "/") {
    return this.url(`/dashboard/${this.trim(path)}`);
  }

  /**
   * Dashboard url.
   *
   * @param {string} path
   * @returns {string}
   */
  static storageUrl(path = "/") {
    return this.url(`/storage/${this.trim(path)}`);
  }

  /**
   * Init
   */
  static init() {
    // INITIALIZATION OF NAVBAR VERTICAL ASIDE
    new HSSideNav(".js-navbar-vertical-aside").init();

    // INITIALIZATION OF BOOTSTRAP DROPDOWN
    HSBsDropdown.init();
  }

  /**
   * style switcher
   */
  static styleSwitcher() {
    const $dropdownBtn = document.getElementById("selectThemeDropdown");
    const $variants = document.querySelectorAll(
      `[aria-labelledby="selectThemeDropdown"] [data-icon]`
    );

    // Function to set active style in the dorpdown menu and set icon for dropdown trigger
    const setActiveStyle = function () {
      $variants.forEach(($item) => {
        if (
          $item.getAttribute("data-value") ===
          HSThemeAppearance.getOriginalAppearance()
        ) {
          $dropdownBtn.innerHTML = `<i class="${$item.getAttribute(
            "data-icon"
          )}" />`;
          return $item.classList.add("active");
        }

        $item.classList.remove("active");
      });
    };

    // Add a click event to all items of the dropdown to set the style
    $variants.forEach(function ($item) {
      $item.addEventListener("click", function () {
        HSThemeAppearance.setAppearance($item.getAttribute("data-value"));
      });
    });

    // Call the setActiveStyle on load page
    setActiveStyle();

    // Add event listener on change style to call the setActiveStyle function
    window.addEventListener("on-hs-appearance-change", function () {
      setActiveStyle();
    });
  }

  /**
   * Delete confirm.
   *
   * @param {string} message
   * @param {function} callback
   */
  static destroy(message, callback) {
    bootbox.confirm({
      message,
      buttons: {
        confirm: {
          className: "btn-danger btn-sm",
          label: `
            <i class="bi-trash me-1"></i>
            <span>Hapus</span>
          `,
        },
        cancel: {
          className: "btn-secondary btn-sm",
          label: `
            <i class="bi-x-lg me-1"></i>
            <span>Batal</span>
          `,
        },
      },
      callback: function (result) {
        callback(result);
      },
    });
  }
}

App.init();
App.styleSwitcher();
