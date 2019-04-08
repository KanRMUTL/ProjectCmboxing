<template>
    <div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal" @click="clearCourse()">
            เพิ่มคอร์ส
        </button>
       <div class="row">
           <div class="box col-md-12">
                <div class="box-body no-padding">
                    <table class="table table-striped" style="text-align:center;">
                        <tbody style="text-align:center;">
                        <tr style="text-align:center;">
                            <td>ชื่อคอร์ส</td>
                            <td>ราคา</td>
                            <td>รายละเอียด</td>
                            <td>แก้ไข</td>
                            <td>ลบ</td>
                        </tr>
                        <tr v-for="(course, index) in courses" :key="index">
                            <td v-text="course.name"></td>
                            <td v-text="course.price"></td>
                            <td v-text="course.detail"></td>
                            <td>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal" @click="getCourseDetail(course)"> แก้ไข</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" @click="deleteCourse(course.id)"> ลบ</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade bd-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content" style="width:800px">
                        <!-- Header -->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h3 class="modal-title" id="exampleModalLabel">จัดการคอร์ส</h3>
                        </div><!-- End Header -->
                        <!-- Body -->
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                        <label for="name">ชื่อคอร์ส</label>
                                        <input type="text" class="form-control" id="name" v-model="course.name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="price">ราคา</label>
                                        <input type="number" class="form-control" id="price" v-model="course.price">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="detail">รายละเอียด</label>
                                        <textarea type="text" class="form-control" id="detail" v-model="course.detail"></textarea>
                                    </div>
                                </div>
                        </div>  <!-- End Body -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal" @click="save()">บันทึก</button>
                        </div>
                    </div>
                </div>
            </div>  <!-- End Modal -->
    </div>
</template>

<script>
export default {
    mounted() {
        this.getAllCourse();
        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        })
    },

    data() {
        return{
            courses: [],
            course: {
                id: 0,
                name: '',
                price: '',
                detail: ''
            },
            modalStatus: 1
        }
     
    },

    methods: {
        getAllCourse()
        {
            axios.get('/api/course').then(
                response => {
                    this.courses = response.data;
                }
            )
        }, 

        getCourseDetail(course)
        {
            this.course.id = course.id;
            this.course.name = course.name;
            this.course.price = course.price;
            this.course.detail = course.detail;
            this.modalStatus = 0;
        },

        save()
        {
            if(this.modalStatus)
            {
                this.addCourse();
            }
            else
            {
                this.updateCourse();
            }
            this.getAllCourse();
        },

        addCourse()
        {
            axios.post('/api/course', {
                name: this.course.name,
                price: this.course.price,
                detail: this.course.detail
            })
        },

        updateCourse()
        {
            axios.put('/api/course/'+this.course.id, {
                name: this.course.name,
                price: this.course.price,
                detail: this.course.detail
            })
        },
        deleteCourse(id)
        {
            swal({
                title: "ยืนยัน",
                text: "คุณต้องการลบคอร์สกล่าวหรือไม่",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    axios.delete('/api/course/'+id);
                    this.getAllCourse();
                    swal("ลบคอร์สเรียบร้อย", {
                        icon: "success",
                    });
                }
            });
        },

        clearCourse() {
            this.course.id = 0,
            this.course.name = '',
            this.course.price = '',
            this.course.detail = ''
        }
        
    },
}
</script>
