<template>
    <table class="table">
        <tr>
            <th class="text-center">
                <span>Coluna do banco de dados</span>
            </th>
            <th class="text-center">
                <span>Coluna do arquivo</span>
            </th>
        </tr>
        <tr v-for="(dbheader, dbindex) in dbheaders" v-bind:key="dbindex">
            <td>{{ dbheader }}</td>
            <td>
                <div class="form=group">
                    <select class="form-control" v-bind:name="dbindex">
                        <option
                            v-for="(header, index) in fileheaders"
                            v-bind:key="index"
                            v-bind:value="index"
                        >{{ header }}</option>
                    </select>
                </div>
            </td>
        </tr>
    </table>
</template>

<script>
export default {
    name: 'CSVHeaders',
    props: ['dbheaders', 'fileheaders']
};
</script>
