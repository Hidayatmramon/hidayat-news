(function($) {
    'use strict';
    var datas = document.currentScript.getAttribute('data-datas');
    var current = document.currentScript.getAttribute('data-current');
    var route = document.currentScript.getAttribute('data-route');
    $(function() {
        window.app = new Vue({
            el: '#app',
            data: {
                datas: JSON.parse(datas),
                current: current,
                newVal: null,
                newKey: null,
                importData : {
                    code : ''
                }
            },
            methods: {
                save() {
                    $('#langForm').submit();
                },
                deleteElement(key) {
                    Vue.delete(this.datas, key);
                },
                addfield() {
                    Vue.set(this.datas, this.newKey, this.newVal);
                    app.newKey = '';
                    app.newVal = '';
                    $("#keyAddModal").modal('hide');
                },
                importKey()
                {
                    var code = this.importData;
                    axios.post(route, code).then(function (res) {
                        app.datas = res.data;
                    })

                }
            }
        })
      });
})(jQuery);
