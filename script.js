var loginBtn = document.getElementById('login-btn')
var creativeBtn = document.getElementById('creative-btn')
var creativeUrlBtn = document.getElementById('creative-url-btn')
var cbCreativeUrlBtn = document.getElementById('cb-creative-url-btn')
var emailInput = document.getElementById('email')
var passInput = document.getElementById('password')
var creativeBtnDiv = document.querySelector('.get_creatives')
var totalCreatives = document.querySelector('.total_creatives')
var totalPages = document.querySelector('.total_pages')

loginBtn.addEventListener('click', function () {
    console.log('login button clicked')
    $.ajax({
        url: 'login.php',
        method: 'POST',
        data: {
            email: emailInput.value,
            password: passInput.value,
            do_login: ''
        },
        dataType: 'json',
        beforeSend: function() {
            $('body').addClass('show-loader')
        },
        complete: function() {
            $('body').removeClass('show-loader')
        },
        success: function (response) {
            console.log(response)
            if (response.status) {
                init_swal(response.message, 'success')
                // loginBtn.classList.add('disabled')
                // emailInput.setAttributeNode(document.createAttribute("disabled"))
                // passInput.setAttributeNode(document.createAttribute("disabled"))
                $(creativeBtnDiv).fadeIn('slow')
            } else {
                init_swal(response.message, 'error')
            }
        }
    })
})

creativeBtn.addEventListener('click', function () {
    console.log('creative info button clicked')
    $.ajax({
        url: 'get_creatives_info.php',
        method: 'GET',
        dataType: 'json',
        beforeSend: function() {
            $('body').addClass('show-loader')
        },
        complete: function() {
            $('body').removeClass('show-loader')
        },
        success: function (response) {
            console.log(response)
            if (response.status) {
                init_swal(response.message, 'success')
                totalCreatives.innerHTML = response.totalCreatives
                totalPages.innerHTML = response.totalPages
                $(creativeBtnDiv).find('.col').fadeIn('slow')
                $(creativeUrlBtn).fadeIn('slow')
                $(cbCreativeUrlBtn).fadeIn('slow')
            } else {
                init_swal(response.message, 'error')
            }
        }
    })
})

creativeUrlBtn.addEventListener('click', function () {
    console.log('creative url button clicked')
    $.ajax({
        url: 'get_creatives_url.php',
        method: 'POST',
        data: {
            total_pages: totalPages.innerHTML
        },
        dataType: 'json',
        beforeSend: function() {
            $('body').addClass('show-loader')
        },
        complete: function() {
            $('body').removeClass('show-loader')
        },
        success: function (response) {
            console.log(response)
            if (response.status) {
                init_swal(response.message, 'success')
                totalCreatives.innerHTML = response.totalCreatives
                totalPages.innerHTML = response.totalPages
                $(creativeBtnDiv).find('.col').fadeIn('slow')
                $(creativeUrlBtn).fadeIn('slow')
                $(cbCreativeUrlBtn).fadeIn('slow')
            } else {
                init_swal(response.message, 'error')
            }
        }
    })
})

function init_swal(message, icon) {
    Swal.fire({
        text: message,
        icon: icon,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
    })
}
