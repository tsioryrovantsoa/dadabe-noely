<script setup lang="ts">
import { Form, Head, Link } from '@inertiajs/vue3';
import GiftCard from '@/components/GiftCard.vue';
import Pagination from '@/components/Pagination.vue';
import ChristmasLayout from '@/layouts/ChristmasLayout.vue';
import { index } from '@/routes/gifts';
import type { Category, Gift, GiftFilters, Paginated } from '@/types';

defineOptions({ layout: ChristmasLayout });

defineProps<{
    gifts: Paginated<Gift>;
    categories: Category[];
    filters: GiftFilters;
}>();
</script>

<template>
    <Head title="Catalogue" />

    <h1 class="font-display text-4xl font-bold text-berry">
        Le catalogue du Père Noël
    </h1>

    <Form
        v-bind="index.form()"
        #default="{ errors }"
        class="mt-6 grid gap-4 rounded-cozy bg-white p-6 shadow-sm sm:grid-cols-2 lg:grid-cols-5"
    >
        <div class="flex flex-col gap-1 lg:col-span-2">
            <label for="name" class="text-sm font-medium">Nom du cadeau</label>
            <input
                id="name"
                name="name"
                type="text"
                :value="filters.name"
                placeholder="Barbie, LEGO..."
                class="rounded-xl border border-cream-dark px-4 py-2.5 focus:border-pine focus:outline-none"
            />
        </div>

        <div class="flex flex-col gap-1">
            <label for="category_id" class="text-sm font-medium"
                >Catégorie</label
            >
            <select
                id="category_id"
                name="category_id"
                class="rounded-xl border border-cream-dark px-4 py-2.5 focus:border-pine focus:outline-none"
            >
                <option value="">Toutes</option>
                <option
                    v-for="category in categories"
                    :key="category.id"
                    :value="category.id"
                    :selected="category.id === filters.category_id"
                >
                    {{ category.name }}
                </option>
            </select>
        </div>

        <div class="flex flex-col gap-1">
            <label for="min_points" class="text-sm font-medium"
                >Points min</label
            >
            <input
                id="min_points"
                name="min_points"
                type="number"
                min="0"
                :value="filters.min_points"
                class="rounded-xl border border-cream-dark px-4 py-2.5 focus:border-pine focus:outline-none"
            />
        </div>

        <div class="flex flex-col gap-1">
            <label for="max_points" class="text-sm font-medium"
                >Points max</label
            >
            <input
                id="max_points"
                name="max_points"
                type="number"
                min="0"
                :value="filters.max_points"
                class="rounded-xl border border-cream-dark px-4 py-2.5 focus:border-pine focus:outline-none"
            />
            <p v-if="errors.max_points" class="text-sm text-berry">
                {{ errors.max_points }}
            </p>
        </div>

        <div class="flex items-end gap-3 sm:col-span-2 lg:col-span-5">
            <button
                type="submit"
                class="rounded-cozy bg-berry px-6 py-2.5 font-display font-semibold text-cream hover:bg-berry-dark"
            >
                Rechercher
            </button>
            <Link :href="index()" class="text-sm text-bark-soft underline">
                Réinitialiser
            </Link>
        </div>
    </Form>

    <p class="mt-8 text-sm text-bark-soft">
        {{ gifts.total }} cadeau(x) trouvé(s)
    </p>

    <div
        v-if="gifts.data.length"
        class="mt-4 grid gap-6 sm:grid-cols-2 lg:grid-cols-4"
    >
        <GiftCard v-for="gift in gifts.data" :key="gift.id" :gift="gift" />
    </div>

    <p v-else class="mt-4 rounded-cozy bg-white p-8 text-center text-bark-soft">
        Aucun cadeau ne correspond à ta recherche.
    </p>

    <div class="mt-10">
        <Pagination :links="gifts.links" />
    </div>
</template>
