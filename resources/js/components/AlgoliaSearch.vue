<template>
    <ais-instant-search
            :search-client="searchClient"
            index-name="users"
    >
        <ais-search-box placeholder="Search contacts..."></ais-search-box>
        <ais-hits>
            <template
                    slot="item"
                    slot-scope="{ item }"
            >
                <h1>
                    <ais-highlight
                            :hit="item"
                            attribute="name"
                    />
                </h1>
            </template>
        </ais-hits>

    </ais-instant-search>
</template>

<script>
    import algoliasearch from 'algoliasearch/lite';

    export default {
        props: ['token', 'identification'],

        data() {
            return {
                searchClient: algoliasearch(
                    this.identification,
                    this.token
                ),
            };
        },
    };
</script>
