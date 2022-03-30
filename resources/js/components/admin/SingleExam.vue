<template>
    <tr>
        <td>{{number}}</td>
        <td>{{subject.subject_name}}</td>
        <td>
            <SingleClass :single="single" :subject="subject" :yellow="yellow" v-for="single in subject.classes" :key="single.id" />
        </td>
    </tr>
</template>

<script>
import SingleClass from './SingleClass'

export default {
    name: "SingleExam",
    props: ['yellow','subject','number','allclasses'],
    components: {
        SingleClass
    },
    data() {
        return {
            name: this.subject.subject_name,
            // classes: this.subject.classes.map(single => single.id),
            // items: this.allclasses.map((single) => {return {text: single.class, value: single.id}}),
            editDialog: false,
            loading: false,
            disableDialog: false,
            deleteDialog: false,
            snackbar: false,
            snackbarText: ''
        }
    },
    methods: {
    },
    computed: {
        getClassList() {
            let classArray = this.subject.classes.map(single => single.class)

            return classArray.join()
        },
        isEqual() {
            let originalClasses = this.subject.classes.map(single => single.id);
            let modifiedClasses = this.classes;

            var union = [...new Set([...originalClasses, ...modifiedClasses])];

            return union.length == originalClasses.length && union.length == modifiedClasses.length
        }
    }
}
</script>

<style>

</style>
