create sequence public.click_new_id_seq;
create table public.click
(
    id bigserial primary key,
    ip inet,
    created_at timestamp(0) default now() not null,
    referer    text,
    user_agent text
);
create table public.actions
(
    id bigserial primary key,
    event_date timestamp(0) not null,
    click_id   bigint       not null,
    created_at timestamp(0),
    updated_at timestamp(0)
);
create index actions_click_id_index on public.actions (click_id);
INSERT INTO public.click (ip,created_at,referer,user_agent) VALUES
    ('127.0.0.1', now(), 'google.com', 'Mozilla'),
    ('192.168.0.1', now(), 'kp.ua', 'Opera');
INSERT INTO public.actions (event_date,click_id,created_at,updated_at) VALUES (now(),1,now(),now());
-- check click with actions
select c.* from public.actions a join public.click c on a.click_id = c.id;
-- check click without actions
select c.* from public.click as c left join public.actions as a on a.click_id = c.id where a.id is NULL;