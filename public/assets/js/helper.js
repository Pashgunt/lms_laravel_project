$(() => {
    $('.registration__helper').hide();
    $('.register__helper__button').on('click', () => {
        $('.registration__helper').show();
    })
    $('.button_close_reg_helper').on('click', () => {
        $('.registration__helper').hide();
    })
})
