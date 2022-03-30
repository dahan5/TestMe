<template>
    <tr>
        <td>{{number}}</td>
        <td>{{student.code}}</td>
        <td>{{student.fullName}}</td>
        <td class="rotated-text" v-for="(subject, index) in student.subjects" :key="index">
            {{ subject ? subject['actual_score'] : "-" }}
        </td>
    </tr>
</template>

<script>
export default {
    name: "SingleScore",
    props: ['yellow','student','number','isadmin'],
    data() {
        return {
            loading: false,
            firstname: this.student.firstname,
            lastname: this.student.lastname
        }
    },
    methods: {
        backToPrevious() {
            this.firstname = this.student.firstname,
            this.lastname = this.student.lastname
        }
    }
}
</script>

<style>

</style>
