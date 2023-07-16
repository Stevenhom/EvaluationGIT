create database event;
alter database event owner to gestion;

\c event gestion

--Creation event cote Back-Office

create table admin(
    idadmin serial primary key,
    name varchar(50),
    email varchar(50),
    pass varchar(50)
);

insert into admin(name,email,pass) values('Admin','admin@admin','123456');

create table artist(
    idartist serial primary key,
    name varchar(50),
    tarif_heure float
);

create table artist_deleted(
    name varchar(50),
    tarif_heure float,
    heure_actuelle TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

create table sonorisation(
    idsono serial primary key,
    type varchar(50),
    tarif_heure float
);

create table sonorisation_deleted(
    type varchar(50),
    tarif_heure float,
    heure_actuelle TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

create table logistique(
    idlogistique serial primary key,
    type varchar(50),
    tarif_jour float
);

create table logistique_deleted(
    type varchar(50),
    tarif_jour float,
    heure_actuelle TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

create table lieu(
    idlieu serial primary key,
    label varchar(50),
    place int,
    cout float
);

create table lieu_deleted(
    label varchar(50),
    place int,
    cout float,
    heure_actuelle TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

create table communication(
    idcommunication serial primary key,
    canal varchar(50),
    cout float
);

create table communication_deleted(
    canal varchar(50),
    cout float,
    heure_actuelle TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

create table transport(
    idtransport serial primary key,
    type varchar(50),
    cout float
);

create table transport_deleted(
    type varchar(50),
    cout float,
    heure_actuelle TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

create table sponsor(
    idsponsor serial primary key,
    label varchar(50),
    cout float
);

create table sponsor_deleted(
    label varchar(50),
    cout float,
    heure_actuelle TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

--Mbola tsy repertorie
create table depense(
    iddepense serial primary key,
    label varchar(50),
    cout float
);

create table depense_deleted(
    label varchar(50),
    cout float,
    heure_actuelle TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

create table spectacle_artist(
    idspectacle_artist serial primary key,
    idspectacle int,
    idartist int,
    foreign key (idspectacle) references Spectacle(idspectacle),
    foreign key (idartist) references artist(idartist),
);

--Creation table Event cote Front-Office

create table Type_event(
    idtype_event serial primary key,
    label varchar(50)
);

create table Spectacle(
    idspectacle serial primary key,
    label
);

insert into Type_event(label) values('Spectacle'),('Fete'),('Tournee');

create table Evenement(
    idEvenement serial primary key,
    idtype_event int,
    name varchar(50),
    idartist int,
    heure_artist int,
    idsono int,
    heure_sono int,
    idlogistique int,
    idlieu int,
    idcommunication int,
    idtransport int,
    idsponsor int,
    iddepense int,
    date_heure TIMESTAMP,
    foreign key (idtype_event) references Type_event(idtype_event),
    foreign key (idartist) references artist(idartist),
    foreign key (idsono) references sonorisation(idsono),
    foreign key (idlogistique) references logistique(idlogistique),
    foreign key (idlieu) references lieu(idlieu),
    foreign key (idcommunication) references communication(idcommunication),
    foreign key (idtransport) references transport(idtransport),
    foreign key (idsponsor) references sponsor(idsponsor),
    foreign key (iddepense) references depense(iddepense)
);

INSERT INTO Evenement (idtype_event, name, idartist, heure_artist, idsono, heure_sono, idlogistique, idlieu, idcommunication, idtransport, idsponsor, iddepense, date_heure)
VALUES (1,'Spectacle 1',1,2,1,3,1,1,1,1,1,1,'2023-07-12 08:00:00');


CREATE OR REPLACE VIEW Event_List AS 
SELECT
    type_event.label,
    evenement.name,
    artist.name AS artist,
    --artist.tarif_heure as tarif_artist_heure,
    evenement.heure_artist,
    sonorisation.type AS sonorisation,
    --sonorisation.tarif_heure as tarif_sono_heure,
    evenement.heure_sono,
    logistique.type AS logistique,
    --logistique.tarif_jour as tarif_logistique_jour,
    lieu.label AS lieu,
    --lieu.place as nombre_place,
    --lieu.cout as cout_lieu,
    communication.canal AS communication,
    --communication.cout as cout_communication,
    transport.type AS transport,
    --transport.cout as cout_transport,
    sponsor.label AS sponsor,
    --sponsor.cout as cout_sponsor,
    depense.label as depense,
    --depense.cout as cout_depense,
    evenement.date_heure as date
FROM
    Evenement
    JOIN type_event ON type_event.idtype_event = Evenement.idtype_event
    JOIN artist ON artist.idartist = Evenement.idartist
    JOIN sonorisation ON sonorisation.idsono = Evenement.idsono
    JOIN logistique ON logistique.idlogistique = Evenement.idlogistique
    JOIN lieu ON lieu.idlieu = Evenement.idlieu
    JOIN communication ON communication.idcommunication = Evenement.idcommunication
    JOIN transport ON transport.idtransport = Evenement.idtransport
    JOIN sponsor ON sponsor.idsponsor = Evenement.idsponsor
    JOIN depense ON depense.iddepense = Evenement.iddepense;



create or replace view devis_artist as
select
    event_list.artist,
    artist.tarif_heure *event_list.heure_artist as cout_artist
from
    artist
    join event_list on artist.name=event_list.artist
where
    event_list.artist = 'Mendev';

create or replace view devis_sono as 
select
    event_list.sonorisation,
    sonorisation.tarif_heure *event_list.heure_sono as cout_sono 
from
    sonorisation
    join event_list on sonorisation.type=event_list.sonorisation
where
    event_list.sonorisation= 'standard';

create or replace view devis as
select
    devis_artist.cout_artist +devis_sono.cout_sono as devis
from 
    event_list
    join devis_artist on devis_artist.artist=event_list.artist
    join devis_sono on devis_sono.sonorisation=event_list.sonorisation;


CREATE TABLE devis (
    iddevis serial primary key,
    idEvenement int,
    tarif_artistes float,
    tarif_sono float,
    tarif_logistique float,
    cout_lieu float,
    autres_depenses float,
    total float,
    foreign key (idEvenement) references Evenement(idEvenement)
);
