/* libs start */
;(function() {
  var canUseWebP = function() {
    var elem = document.createElement('canvas');

    if (!!(elem.getContext && elem.getContext('2d'))) {
        // was able or not to get WebP representation
        return elem.toDataURL('image/webp').indexOf('data:image/webp') == 0;
    }

    // very old browser like IE 8, canvas not supported
    return false;
  };
  
  var isWebpSupported = canUseWebP();

  if (isWebpSupported === false) {
    var lazyItems = document.querySelectorAll('[data-src-replace-webp]');

    for (var i = 0; i < lazyItems.length; i += 1) {
      var item = lazyItems[i];

      var dataSrcReplaceWebp = item.getAttribute('data-src-replace-webp');
      if (dataSrcReplaceWebp !== null) {
        item.setAttribute('data-src', dataSrcReplaceWebp);
      }
    }
  }

  var lazyLoadInstance = new LazyLoad({
    elements_selector: ".lazy"
  });
})();
/* libs end */

/* myLib start */
;(function() {
  window.myLib = {};

  window.myLib.body = document.querySelector('body');

  window.myLib.closestAttr = function(item, attr) {
    var node = item;

    while(node) {
      var attrValue = node.getAttribute(attr);
      if (attrValue) {
        return attrValue;
      }

      node = node.parentElement;
    }

    return null;
  };

  window.myLib.closestItemByClass = function(item, className) {
    var node = item;

    while(node) {
      if (node.classList.contains(className)) {
        return node;
      }

      node = node.parentElement;
    }

    return null;
  };

  window.myLib.toggleScroll = function() {
    myLib.body.classList.toggle('no-scroll');
  };
})();
/* myLib end */

/* header start */
;(function() {
  if (window.matchMedia('(max-width: 992px)').matches) {
    return;
  }

  var headerPage = document.querySelector('.header-page');

  window.addEventListener('scroll', function() {
    if (window.pageYOffset > 0) {
      headerPage.classList.add('is-active');
    } else {
      headerPage.classList.remove('is-active');
    }
  });
})();
/* header end */

/*profile start*/

/* profile team start */
;(function() {
  var container = document.querySelector('.scroll-container');

  if (container === null) {
    return;
  }

  var removeChildren = function(item) {
    while (item.firstChild) {
      item.removeChild(item.firstChild);
    }
  };

  var updateChildren = function(item, children) {
    removeChildren(item);
    for (var i = 0; i < children.length; i += 1) {
      item.appendChild(children[i]);
    }
  };

  var buttons = document.querySelector('.consultant_button')
  if (buttons === null) {
    return;
  }
  buttons = buttons.querySelectorAll('.order-button');

  var orderItems = container.querySelectorAll('.order-box');

  var filterValue = localStorage.getItem('selectedFilter') || 'fresh';
  localStorage.setItem('selectedFilter', filterValue);

  var filteredItems = [];
  for (var i = 0; i < orderItems.length; i += 1) {
    var current = orderItems[i];
    if (current.getAttribute('data-category') === filterValue) {
      filteredItems.push(current);
    }
  }
  updateChildren(container, filteredItems);

  buttons.forEach(function (element) {
    var filterCurrent = element.getAttribute('data-filter');
    if(filterValue === filterCurrent) {
      element.classList.add('is-active');
    }
  });



  var infoNotApl = document.querySelector('.notApl');

  if(filteredItems.length === 0) {
    infoNotApl.style.display = "flex";
  } else {
    infoNotApl.style.display = "none";
  }

  buttons.forEach(function (element) {
    element.addEventListener('click', function(e) {
      window.location.reload();
    var item = e.target;
    if (item === null || item.classList.contains('is-active')) {
      return;
    }
    var buttons_area = document.querySelector('.consultant_button');
    e.preventDefault();
    var filterValue = item.getAttribute('data-filter');
    var previousBtnActive = buttons_area.querySelector('.order-button.is-active');


    previousBtnActive.classList.remove('is-active');

    item.classList.add('is-active');

    var filteredItems = [];
    for (var i = 0; i < orderItems.length; i += 1) {
      var current = orderItems[i];
      if (current.getAttribute('data-category') === filterValue) {
        filteredItems.push(current);
      }
    }

    updateChildren(container, filteredItems);

    var infoNotApl = document.querySelector('.notApl');

    if(filteredItems.length === 0) {
      infoNotApl.style.display = "flex";
    } else {
      infoNotApl.style.display = "none";
    }

      localStorage.setItem('selectedFilter', filterValue);
  });
});
})();
/* profile team end */

// Функция для переключения списка
function toggleList(label, list) {
  if (list.style.display === 'block') {
    list.style.display = 'none';
  } else {
    showOnlyOneList(list);
  }
}

// Функция для показа только одного списка
function showOnlyOneList(listToShow) {
  document.querySelectorAll('.employeesList').forEach(function(list) {
    list.style.display = 'none';
  });
  if(listToShow) {
    listToShow.style.display = 'block';
  }
}

// Инициализация обработчиков события клика для всех label
document.querySelectorAll('.employees').forEach(function(label) {
  var associatedList = label.nextElementSibling; // Предполагаем, что список следует сразу за label
  label.addEventListener('click', function(event) {
    toggleList(label, associatedList);
    event.stopPropagation();
  });
});

// Функция выбора сотрудника
function selectEmployee(label, employeeName) {
  label.textContent = employeeName; // Обновляем текст label
  document.getElementById('inputEmp').value = employeeName; // Сохраняем значение в скрытый input
  showOnlyOneList(null); // Закрываем все списки
}

// Инициализация обработчиков события клика для элементов списка
document.querySelectorAll('.employeesList .employee').forEach(function(employee) {
  employee.addEventListener('click', function(event) {
    var label = employee.closest('.employeesList').previousElementSibling; // Находим соответствующий label
    selectEmployee(label, employee.textContent);
    event.stopPropagation();
  });
});

// Обработчик кликов для всего документа, закрывающий все списки при клике вне их
document.addEventListener('click', function() {
  showOnlyOneList(null);
});

document.addEventListener('DOMContentLoaded', function() {
  var inputFileElement = document.getElementById('inputFile');
  if(inputFileElement) {
    inputFileElement.addEventListener('change', function() {
      var fileName = this.files[0].name;
      document.getElementById('fileChosen').textContent = fileName;
    });
  }
});
/*

function getPosition(element) {
  var rect = element.getBoundingClientRect();
  return {
    top: rect.top + window.scrollY,
    left: rect.left + window.scrollX
  };
}

document.addEventListener('DOMContentLoaded', function() {
  var selectLabel = document.getElementById('employees');
  selectLabel.addEventListener('click', function() {
    var popup = document.getElementById('employeesList');
    var pos = getPosition(this);

    popup.style.position = 'absolute';
    popup.style.top = pos.top + '100px';
    popup.style.left = pos.left + '100px';

    popup.style.display = 'block'; // Показываем всплывающее окно
  });
});
*/

/*profile end*/

/* popup start */
;(function() {
  var showPopup = function(target) {
    target.classList.add('is-active');
  };

  var closePopup = function(target) {
    target.classList.remove('is-active');
  };

  myLib.body.addEventListener('click', function(e) {
    var target = e.target;
    var popupClass = myLib.closestAttr(target, 'data-popup');

    if (popupClass === null) {
      return;
    }

    e.preventDefault();
    var popup = document.querySelector('.' + popupClass);

    if (popup) {
      showPopup(popup);
      myLib.toggleScroll();
    }
  });

  myLib.body.addEventListener('click', function(e) {
    var target = e.target;

    if (target.classList.contains('popup-close') ||
        target.classList.contains('popup__inner')) {
          var popup = myLib.closestItemByClass(target, 'popup');

          closePopup(popup);
          myLib.toggleScroll();
    }
  });

  myLib.body.addEventListener('keydown', function(e) {
    if (e.keyCode !== 27) {
      return;
    }

    var popup = document.querySelector('.popup.is-active');

    if (popup) {
      closePopup(popup);
      myLib.toggleScroll();
    }
  });
})();

/* popup end */

/* scrollTo start */
;(function() {


  var scroll = function(target) {
    var targetTop = target.getBoundingClientRect().top;
    var scrollTop = window.pageYOffset;
    var targetOffsetTop = targetTop + scrollTop;
    var headerOffset = document.querySelector('.header-page').clientHeight;

    window.scrollTo(0, targetOffsetTop - headerOffset);
  }

  myLib.body.addEventListener('click', function(e) {
    var target = e.target;
    var scrollToItemClass = myLib.closestAttr(target, 'data-scroll-to');

    if (scrollToItemClass === null) {
      return;
    }

    e.preventDefault();
    var scrollToItem = document.querySelector('.' + scrollToItemClass);

    if (scrollToItem) {
      scroll(scrollToItem);
    }
  });
})();
/* scrollTo end */

/* catalog start */
;(function() {
  var catalogSection = document.querySelector('.section-catalog');

  if (catalogSection === null) {
    return;
  }

  var removeChildren = function(item) {
    while (item.firstChild) {
      item.removeChild(item.firstChild);
    }
  };

  var updateChildren = function(item, children) {
    removeChildren(item);
    for (var i = 0; i < children.length; i += 1) {
      item.appendChild(children[i]);
    }
  };

  var catalog = catalogSection.querySelector('.catalog');
  var catalogNav = catalogSection.querySelector('.catalog-nav');
  var catalogItems = catalogSection.querySelectorAll('.catalog__item');

  catalogNav.addEventListener('click', function(e) {
    var target = e.target;
    var item = myLib.closestItemByClass(target, 'catalog-nav__btn');

    if (item === null || item.classList.contains('is-active')) {
      return;
    }

    e.preventDefault();
    var filterValue = item.getAttribute('data-filter');
    var previousBtnActive = catalogNav.querySelector('.catalog-nav__btn.is-active');

    previousBtnActive.classList.remove('is-active');
    item.classList.add('is-active');

    if (filterValue === 'all') {
      updateChildren(catalog, catalogItems);
      return;
    }

    var filteredItems = [];
    for (var i = 0; i < catalogItems.length; i += 1) {
      var current = catalogItems[i];
      if (current.getAttribute('data-category') === filterValue) {
        filteredItems.push(current);
      }
    }

    updateChildren(catalog, filteredItems);
  });
})();
/* catalog end */

/* product start */
;(function() {
  var catalog = document.querySelector('.catalog');

  if (catalog === null) {
    return;
  }

  var updateProductPrice = function(product, price) {
    var productPrice = product.querySelector('.product__price-value');
    productPrice.textContent = price;
  };

  var changeProductSize = function(target) {
    var product = myLib.closestItemByClass(target, 'product');
    var previousBtnActive = product.querySelector('.product__size.is-active');
    var newPrice = target.getAttribute('data-product-size-price');

    previousBtnActive.classList.remove('is-active');
    target.classList.add('is-active');
    updateProductPrice(product, newPrice);
  };

  var changeProductOrderInfo = function(target) {
    var product = myLib.closestItemByClass(target, 'product');
    var order = document.querySelector('.popup-order');

    var productTitle = product.querySelector('.product__title').textContent;
    var productPrice = product.querySelector('.product__price-value').textContent;
    var productImgSrc = product.querySelector('.product__img').getAttribute('src');

    order.querySelector('.order-info-title').setAttribute('value', productTitle);
    order.querySelector('.order-info-price').setAttribute('value', productPrice);

    order.querySelector('.order-product-title').textContent = productTitle;
    order.querySelector('.order-product-price').textContent = productPrice;
    order.querySelector('.order__img').setAttribute('src', productImgSrc);
  };

  catalog.addEventListener('click', function(e) {
    var target = e.target;

    if (target.classList.contains('product__size') && !target.classList.contains('is-active')) {
      e.preventDefault();
      changeProductSize(target);
    }

    if (target.classList.contains('product__btn')) {
      e.preventDefault();
      changeProductOrderInfo(target);
    }
  });
})();
/* product end */

/* map start */
;(function() {

  document.addEventListener('DOMContentLoaded', function() {
    var sectionContacts = document.querySelector('.section-contacts');
    if(sectionContacts) {

  var ymapInit = function() {
    if (typeof ymaps === 'undefined') {
      return;
    }
  
    ymaps.ready(function () {
      var myMap = new ymaps.Map('ymap', {
              center: [55.755241, 37.617779],
              zoom: 16
          }, {
              searchControlProvider: 'yandex#search'
          }),
  
          myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
              balloonContent: 'г. Москва, Преображенская площадь, 8'
          }, {
              iconLayout: 'default#image',
              iconImageHref: '../img/common/markers.svg',
              iconImageSize: [40, 63.2],
              iconImageOffset: [-50, -38]
          });
  
      myMap.geoObjects.add(myPlacemark);
  
      myMap.behaviors.disable('scrollZoom');
    });
  };

  var ymapLoad = function() {
    var script = document.createElement('script');
    script.src = 'https://api-maps.yandex.ru/2.1/?lang=en_RU';
    myLib.body.appendChild(script);
    script.addEventListener('load', ymapInit);
  };

  var checkYmapInit = function() {
    var sectionContactsTop = sectionContacts.getBoundingClientRect().top;
    var scrollTop = window.pageYOffset;
    var sectionContactsOffsetTop = scrollTop + sectionContactsTop;

    if (scrollTop + window.innerHeight > sectionContactsOffsetTop) {
      ymapLoad();
      window.removeEventListener('scroll', checkYmapInit);
    }
  };



  window.addEventListener('scroll', checkYmapInit);
  checkYmapInit();
  }
});
})();
/* map end */

/* form start */
;(function() {
  var forms = document.querySelectorAll('.form-send');

  if (forms.length === 0) {
    return;
  }

  var serialize = function(form) {
    var items = form.querySelectorAll('input, select, textarea');
    var str = '';
    for (var i = 0; i < items.length; i += 1) {
      var item = items[i];
      var name = item.name;
      var value = item.value;
      var separator = i === 0 ? '' : '&';

      if (value) {
        str += separator + name + '=' + value;
      }
    }
    return str;
  };

  var formSend = function(form) {
    var data = serialize(form);
    var xhr = new XMLHttpRequest();
    var url = 'backend/mail.php';
    var url_backend = 'backend/database.php';
    
    xhr.open('POST', url);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
      var activePopup = document.querySelector('.popup.is-active');

      if (activePopup) {
        activePopup.classList.remove('is-active');
      } else {
        myLib.toggleScroll();
      }

      if (xhr.response === 'success') {
        document.querySelector('.popup-thanks').classList.add('is-active');
      } else {
        document.querySelector('.popup-error').classList.add('is-active');
      }

      form.reset();
    };

    xhr.send(data);

    var xhr2 = new XMLHttpRequest();
    xhr2.open('POST', url_backend);
    xhr2.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr2.send(data);
  };

  for (var i = 0; i < forms.length; i += 1) {
    forms[i].addEventListener('submit', function(e) {
      e.preventDefault();
      var form = e.currentTarget;
      formSend(form);
    });
  }
})();
/* form end */