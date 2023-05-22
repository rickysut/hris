export default () => ({

  whenFields: {},
  init (whenFields) {
    this.whenFields = whenFields
  },
  precognition (form) {
    form.querySelector('.form_submit_button').
      setAttribute('disabled', 'true')
    form.querySelector('.form_submit_button').innerHTML = translates.loading
    form.querySelector('.precognition_errors').innerHTML = ''

    axios.post(form.getAttribute('action'), new FormData(form), {
      headers: {
        Precognition: true,
        Accept: 'application/json',
        'Content-Type': form.getAttribute('enctype'),
      },
    }).then(function (response) {
      form.submit()
    }).catch(errorResponse => {
      form.querySelector(
        '.form_submit_button').innerHTML = translates.saved_error
      form.querySelector('.form_submit_button').removeAttribute('disabled')

      let errors = ''
      let errorsData = errorResponse.response.data.errors
      for (const error in errorsData) {
        errors = errors + '<div class="mt-2 text-pink">' + errorsData[error] +
          '</div>'
      }

      form.querySelector('.precognition_errors').innerHTML = errors
    })

    return false
  }

})