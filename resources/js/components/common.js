import {mapGetters} from 'vuex'
export default {
    data() {
        return {

        }
    },
    methods: {
        async callApi(method, url, dataObj) {
            try {
                return await axios({
                    method: method,
                    url: url,
                    data: dataObj
                });
            } catch (e) {
                return e.response

            }
        },

        info(desc, title = "hello") {
            this.$Notice.info({
                title: title,
                desc: desc
            });
        },

        success(desc, title = "success") {
            this.$Notice.success({
                title: title,
                desc: desc
            });
        },
        warning(desc, title = "warning") {
            this.$Notice.warning({
                title: title,
                desc: desc
            });
        },

        error(desc, title = "danger") {
            this.$Notice.error({
                title: title,
                desc: desc
            });
        },

        smwr(desc = 'something went wrong', title = "Oops!") {
            this.$Notice.error({
                title: title,
                desc: desc
            });
        },
        checkUserPermission(key){
            if (!this.userPermission) return  true
            let isPermitted = false;
            for (let d of this.userPermission){
                if (d[key]){
                    isPermitted = true
                    break;
                }else{
                    break
                }
            }
            return isPermitted
        }

    },
    computed:{
        ...mapGetters({'userPermission' : 'getUserPermission'}),
        canRead(){
           return this.checkUserPermission('read')
        },
        canWrite(){
            return this.checkUserPermission('write')

        },
        canDelete(){
            return this.checkUserPermission('delete')

        },
        canUpdate(){
            return this.checkUserPermission('update')

        },
    }
}
