<template>
    <nav aria-label="...">
        <ul class="pagination">
            <li class="page-item" v-if="previous !== null">
                <a class="page-link" :href="previous">{{ current - 1}}</a>
            </li>

            <li class="page-item active">
                <a class="page-link" href="">{{ current }}</a>
            </li>

            <li class="page-item" v-if="next !== null">
                <a class="page-link" :href="next">{{ current + 1}}</a>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    props: ['current', 'next', 'previous'],
    methods: {
    }
}
</script>
